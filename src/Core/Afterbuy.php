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
use Symfony\Contracts\HttpClient\ResponseInterface;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Extends\DateTime;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoLoggerInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestDtoInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyResponseInterface;
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
    }

    /**
     * @return AfterbuyResponseInterface<T>
     */
    public function runRequest(AfterbuyRequestInterface $afterbuyRequest, ?ResponseInterface $response = null): AfterbuyResponseInterface
    {
        $method = $afterbuyRequest->method()->value;
        $callName = $afterbuyRequest->callName();
        $requestDto = $afterbuyRequest->requestDto();
        $payload = $afterbuyRequest->payload($this->afterbuyGlobal);
        $query = $afterbuyRequest->query();
        $responseClass = $afterbuyRequest->responseClass();
        $uri = $afterbuyRequest->uri($this->endpointEnum);
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

        if (str_ends_with($uri, '/')) {
            $uri = substr($uri, 0, -1);
        }

        /** validate the request class */
        if ($requestDto instanceof AfterbuyRequestDtoInterface) {
            $constraintViolationList = $this->getValidator()->validate($requestDto);
            if ($constraintViolationList->count() > 0) {
                $loggerMessages = [];
                foreach ($constraintViolationList as $error) {
                    $loggerMessages[] = sprintf('%s: %s', $error->getPropertyPath(), $error->getMessage());
                }

                $this->appendLogMessage(
                    LogLevel::WARNING,
                    sprintf('Afterbuy SDK %s', $requestDto::class),
                    $uri,
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
            && $requestDto instanceof AfterbuyRequestDtoInterface
            && ! $response instanceof ResponseInterface
        ) {
            $info = 'According to the Afterbuy documentation, the scheme should be changed from https to http for the test environment. ' .
                    'However, this is currently not working as expected - all changes continue to affect the production environment. ' .
                    'This afterbuy sdk always returns default a successful response if it is an update request. ' .
                    'Alternatively you can pass your own update response class.';

            $this->appendLogMessage(
                LogLevel::INFO,
                sprintf('Afterbuy SDK %s', $afterbuyRequest::class),
                $uri,
                $method,
                $payload,
                $query,
                [$info],
            );

            $defaultResponse = sprintf(
                '<?xml version="1.0" encoding="UTF-8" sandbox="true"?>' .
                '<Afterbuy><CallStatus>Success</CallStatus><CallName>%s</CallName><VersionID>%f</VersionID></Afterbuy>',
                htmlspecialchars($callName, ENT_XML1),
                self::DefaultSandboxVersion
            );
            $response = new AfterbuySandboxResponse($defaultResponse);
        }

        /** $response is always null, this variable is only filled in for the unit test */
        if (! $response instanceof ResponseInterface) {
            try {
                $response = HttpClient::create()->request(
                    $method,
                    $uri,
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
            $response = (new ReflectionClass($responseClass))->newInstance($dataMapper, $response, $this->endpointEnum);
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if (! $response instanceof AfterbuyResponseInterface) {
            throw new RuntimeException('Response class does not implement AfterbuyResponseInterface');
        }

        $callStatusEnum = $response->getCallStatus();
        $loggerMessages = match ($callStatusEnum) {
            CallStatusEnum::ERROR => $response->getErrorMessages(),
            CallStatusEnum::WARNING => $response->getWarningMessages(),
            default => [],
        };

        $this->appendLogMessage(
            $callStatusEnum->getPsr3Level(),
            sprintf('Afterbuy SDK %s', $afterbuyRequest::class),
            $uri,
            $method,
            $payload,
            $query,
            $this->getAfterbuyDtoLoggerArray($loggerMessages),
        );

        return $response;
    }

    /**
     * @param AfterbuyDtoLoggerInterface[] $afterbuyDtoLogger
     * @return string[]
     */
    public function getAfterbuyDtoLoggerArray(array $afterbuyDtoLogger): array
    {
        return array_map(fn (AfterbuyDtoLoggerInterface $afterbuyDtoLogger): string => $afterbuyDtoLogger->getMessage(), $afterbuyDtoLogger);
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
        string $uri,
        string $method,
        string $payload,
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
            'uri' => $uri,
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
