<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Core;

use DateTimeInterface;
use Exception;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use ReflectionClass;
use RuntimeException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Validator\ConstraintValidatorFactoryInterface;
use Symfony\Component\Validator\ContainerConstraintValidatorFactory;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface as HttpClientResponseInterface;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Extension\HttpClientHelper;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoInterface;
use Wundii\AfterbuySdk\Interface\RequestInterface;
use Wundii\AfterbuySdk\Interface\ResponseDtoLoggerInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\DataMapper\DataConfig;
use Wundii\DataMapper\DataMapper;
use Wundii\DataMapper\Enum\ApproachEnum;

/**
 * @template T of object
 */
readonly class Afterbuy
{
    /**
     * @var int
     */
    public const DefaultSandboxVersion = 8;

    public function __construct(
        private AfterbuyGlobalInterface $afterbuyGlobal,
        private EndpointEnum $endpointEnum,
        private ?LoggerInterface $logger = null,
        private ?ValidatorBuilder $validatorBuilder = null,
        private bool $debugMode = false,
    ) {
        $this->afterbuyGlobal->setEndpointEnum($this->endpointEnum);
    }

    /**
     * @return ResponseInterface<T>
     */
    public function runRequest(RequestInterface $afterbuyRequest, ?HttpClientResponseInterface $httpClientResponse = null): ResponseInterface
    {
        $method = $afterbuyRequest->method()->value;
        $callName = $afterbuyRequest->callName();
        $requestDto = $afterbuyRequest->requestDto();
        $payload = $afterbuyRequest->payload($this->afterbuyGlobal);
        $query = $afterbuyRequest->query();
        $responseClass = $afterbuyRequest->responseClass();
        $url = $afterbuyRequest->url($this->endpointEnum);
        $dataConfig = new DataConfig(
            ApproachEnum::SETTER,
            classMap: [
                DateTimeInterface::class => DateTime::class,
            ]
        );
        $dataMapper = new DataMapper($dataConfig);

        if (! class_exists($responseClass)) {
            throw new RuntimeException('Response class does not exist');
        }

        /** validate the request class */
        if ($requestDto instanceof RequestDtoInterface) {
            $constraintViolationList = $this->getValidator()->validate($requestDto);
            if ($constraintViolationList->count() > 0) {
                $loggerMessages = [];
                foreach ($constraintViolationList as $error) {
                    $loggerMessages[] = sprintf('%s: %s', $error->getPropertyPath(), $error->getMessage());
                }

                $this->appendLogMessage(
                    LogLevel::WARNING,
                    sprintf('Afterbuy SDK %s', $requestDto::class),
                    $url,
                    $method,
                    $payload,
                    $query,
                    $loggerMessages,
                );

                throw new InvalidArgumentException('Request class is not valid: ' . implode(', ', $loggerMessages));
            }
        }

        if (
            $this->endpointEnum === EndpointEnum::SANDBOX
            && $requestDto instanceof RequestDtoInterface
            && ! $httpClientResponse instanceof HttpClientResponseInterface
        ) {
            $info = 'According to the Afterbuy documentation, the scheme should be changed from https to http for the test environment. ' .
                    'However, this is currently not working as expected - all changes continue to affect the production environment. ' .
                    'This afterbuy sdk always returns default a successful response if it is an update request. ' .
                    'Alternatively you can pass your own update response class.';

            $this->appendLogMessage(
                LogLevel::INFO,
                sprintf('Afterbuy SDK %s', $afterbuyRequest::class),
                $url,
                $method,
                $payload,
                $query,
                [$info],
            );

            $defaultShopApiResponse = sprintf(
                '<?xml version="1.0" encoding="utf-8"?>' .
                '<result><sandbox>%s</sandbox><success>1</success><data/></result>',
                AfterbuyApiSourceEnum::SHOP->value,
            );
            $defaultXmlApiResponse = sprintf(
                '<?xml version="1.0" encoding="utf-8"?>' .
                '<Afterbuy><Sandbox>%s</Sandbox><CallStatus>Success</CallStatus><CallName>%s</CallName><VersionID>%f</VersionID></Afterbuy>',
                AfterbuyApiSourceEnum::XML->value,
                htmlspecialchars($callName, ENT_XML1),
                self::DefaultSandboxVersion
            );

            $defaultResponse = str_contains($url, 'ShopInterface')
                ? $defaultShopApiResponse
                : $defaultXmlApiResponse;

            $httpClientResponse = new AfterbuySandboxResponse($defaultResponse);
        }

        /** $response is always null, this variable is only filled in for the unit test */
        if (! $httpClientResponse instanceof HttpClientResponseInterface) {
            if (HttpClientHelper::uriLength($url, $query) > HttpClientHelper::URI_MAX_LENGTH) {
                throw new InvalidArgumentException('URI is too long (more than 2048 characters), please reduce the query parameters');
            }

            try {
                $httpClientResponse = HttpClient::create()->request(
                    $method,
                    $url,
                    [
                        'headers' => [
                            'Content-Type: application/xml; charset=utf-8',
                        ],
                        'body' => $payload,
                        'http_version' => 2.0,
                        'query' => $query,
                        'verify_host' => 0,
                        'verify_peer' => 0,
                    ]
                );
            } catch (TransportExceptionInterface $exception) {
                throw new RuntimeException($exception->getMessage(), $exception->getCode(), $exception);
            }
        }

        try {
            $httpClientResponse = (new ReflectionClass($responseClass))->newInstance($dataMapper, $httpClientResponse, $this->endpointEnum);
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if (! $httpClientResponse instanceof ResponseInterface) {
            throw new RuntimeException('Response class does not implement AfterbuyResponseInterface');
        }

        $callStatusEnum = $httpClientResponse->getCallStatus();
        $loggerMessages = match ($callStatusEnum) {
            CallStatusEnum::ERROR => $httpClientResponse->getErrorMessages(),
            CallStatusEnum::WARNING => $httpClientResponse->getWarningMessages(),
            default => [],
        };

        $this->appendLogMessage(
            $callStatusEnum->getPsr3Level(),
            sprintf('Afterbuy SDK %s', $afterbuyRequest::class),
            $url,
            $method,
            $payload,
            $query,
            $this->getResponseDtoLoggerArray($loggerMessages),
        );

        return $httpClientResponse;
    }

    /**
     * @param ResponseDtoLoggerInterface[] $responseDtoLogger
     * @return string[]
     */
    public function getResponseDtoLoggerArray(array $responseDtoLogger): array
    {
        return array_map(fn (
            ResponseDtoLoggerInterface $responseDtoLogger
        ): string => $responseDtoLogger->getMessage(), $responseDtoLogger);
    }

    public function getValidator(): ValidatorInterface
    {
        $validationBuilder = $this->validatorBuilder ?? Validation::createValidatorBuilder();
        $validationBuilder->enableAttributeMapping();
        $validationBuilder->setConstraintValidatorFactory($this->getConstraintValidatorFactory());
        return $validationBuilder->getValidator();
    }

    public function getAfterbuyGlobal(): AfterbuyGlobalInterface
    {
        return $this->afterbuyGlobal;
    }

    private function getConstraintValidatorFactory(): ConstraintValidatorFactoryInterface
    {
        $containerBuilder = new ContainerBuilder();

        /**
         * register all services are needed for the validator
         */
        $containerBuilder->register(PropertyAccessorInterface::class, PropertyAccessor::class)
            ->addArgument(PropertyAccessor::MAGIC_GET | PropertyAccessor::MAGIC_SET)
            ->addArgument(PropertyAccessor::THROW_ON_INVALID_PROPERTY_PATH)
            ->addArgument(null)
            ->addArgument(new ReflectionExtractor([], null, null, true));

        /**
         * autowire all validators
         */
        try {
            $phpFileLoader = new PhpFileLoader($containerBuilder, new FileLocator(__DIR__));
            $phpFileLoader->load(__DIR__ . '/../Config/Container.php');
        } catch (Exception $exception) {
            throw new RuntimeException('Error loading container file: ' . $exception->getMessage(), $exception->getCode(), $exception);
        }

        $containerBuilder->compile();
        return new ContainerConstraintValidatorFactory($containerBuilder);
    }

    /**
     * @param string[] $query
     * @param string[] $messages
     */
    private function appendLogMessage(
        string $level,
        string $message,
        string $url,
        string $method,
        ?string $payload,
        array $query,
        array $messages,
    ): void {
        if (! $this->logger instanceof LoggerInterface) {
            return;
        }

        if ($level === LogLevel::DEBUG && $this->debugMode === false) {
            return;
        }

        $context = [
            'url' => $url,
            'method' => $method,
            'payload' => $payload,
            'query' => $query,
            'messages' => $messages,
        ];

        $this->logger->log(
            $level,
            $message,
            $context,
        );
    }
}
