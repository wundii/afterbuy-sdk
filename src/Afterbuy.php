<?php

declare(strict_types=1);

namespace AfterbuySdk;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Extends\DateTime;
use AfterbuySdk\Interface\AfterbuyDtoLoggerInterface;
use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use DateTimeInterface;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use ReflectionException;
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
     * @throws TransportExceptionInterface
     * @throws ReflectionException
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
        }

        $response = (new ReflectionClass($responseClass))->newInstance($dataMapper, $response);
        if (! $response instanceof AfterbuyResponseInterface) {
            throw new RuntimeException('Response class does not implement AfterbuyResponseInterface');
        }

        if ($this->logger instanceof LoggerInterface) {
            $errorMessages = $response->getErrorMessages();
            $warningMessages = $response->getWarningMessages();
            $loggerMessage = sprintf('Afterbuy SDK %s', $afterbuyRequest::class);
            $loggerContext = [
                'uri' => $uri,
                'method' => $method,
                'payload' => $payload,
                'query' => $query,
            ];

            if ($errorMessages !== []) {
                $this->logger->error($loggerMessage, [
                    ...$loggerContext,
                    'response' => $this->getAfterbuyDtoLoggerArray($errorMessages),
                ]);
            }

            if ($warningMessages !== []) {
                $this->logger->warning($loggerMessage, [
                    ...$loggerContext,
                    'response' => $this->getAfterbuyDtoLoggerArray($warningMessages),
                ]);
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
