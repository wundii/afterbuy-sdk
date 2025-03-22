<?php

declare(strict_types=1);

namespace AfterbuySdk;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Extends\DateTime;
use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Response\AfterbuyErrorResponse;
use DateTimeInterface;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use ReflectionException;
use RuntimeException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
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
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
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

        /** $response ist immer null, lediglich bei bei den Unittest wird diese Variable befüllt */
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

        $matches = [];
        preg_match('/<CallStatus>(.*)<\/CallStatus>/s', $response->getContent(false), $matches);
        $callStatus = $matches[1] ?? null;

        if ($callStatus === 'Error') {
            $responseClass = AfterbuyErrorResponse::class;
        }

        $response = (new ReflectionClass($responseClass))->newInstance($dataMapper, $response);
        if (! $response instanceof AfterbuyResponseInterface) {
            throw new RuntimeException('Response class does not implement AfterbuyResponseInterface');
        }

        $errorMessages = $response->getErrorMessages();
        if ($errorMessages !== [] && $this->logger instanceof LoggerInterface) {
            $this->logger->error(sprintf('Afterbuy SDK %s', $afterbuyRequest::class), [
                'uri' => $uri,
                'method' => $method,
                'payload' => $payload,
                'query' => $query,
                'response' => $errorMessages,
            ]);
        }

        return $response;
    }
}
