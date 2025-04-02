<?php

declare(strict_types=1);

namespace AfterbuySdk;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\CallStatusEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Extends\DateTime;
use AfterbuySdk\Interface\AfterbuyDtoLoggerInterface;
use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use DateTimeInterface;
use Exception;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use RuntimeException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Wundii\DataMapper\DataConfig;
use Wundii\DataMapper\DataMapper;
use Wundii\DataMapper\Enum\ApproachEnum;

/**
 * @template T of object
 */
final readonly class Afterbuy
{
    public function __construct(
        private AfterbuyGlobal $afterbuyGlobal,
        private EndpointEnum $endpointEnum,
        private ?LoggerInterface $logger = null,
    ) {
    }

    /**
     * @return AfterbuyResponseInterface<T>
     */
    public function runRequest(AfterbuyRequestInterface $afterbuyRequest, ?ResponseInterface $response = null): AfterbuyResponseInterface
    {
        $method = $afterbuyRequest->method()->value;
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
            $response = (new ReflectionClass($responseClass))->newInstance($dataMapper, $response);
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if (! $response instanceof AfterbuyResponseInterface) {
            throw new RuntimeException('Response class does not implement AfterbuyResponseInterface');
        }

        if ($this->logger instanceof LoggerInterface) {
            $callStatusEnum = $response->getCallStatus();
            $loggerMessage = sprintf('Afterbuy SDK %s', $afterbuyRequest::class);
            $loggerMessages = match ($callStatusEnum) {
                CallStatusEnum::ERROR => $response->getErrorMessages(),
                CallStatusEnum::WARNING => $response->getWarningMessages(),
                default => [],
            };

            if ($loggerMessages !== []) {
                $loggerContext = [
                    'uri' => $uri,
                    'method' => $method,
                    'payload' => $payload,
                    'query' => $query,
                    'response' => $this->getAfterbuyDtoLoggerArray($loggerMessages),
                ];

                $this->logger->log(
                    $callStatusEnum->getPsr3Level(),
                    $loggerMessage,
                    $loggerContext,
                );
            }
        }

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
}
