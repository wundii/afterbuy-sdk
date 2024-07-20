<?php

declare(strict_types=1);

namespace AfterbuySdk;

use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
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

final readonly class Afterbuy
{
    public function __construct(
        private ?LoggerInterface $logger = null,
    ) {
    }

    /**
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     */
    public function runRequest(AfterbuyRequestInterface $afterbuyRequest, ?ResponseInterface $response = null): AfterbuyResponseInterface
    {
        $method = $afterbuyRequest->method()->value;
        $payload = $afterbuyRequest->payload();
        $query = $afterbuyRequest->query();
        $responseClass = $afterbuyRequest->responseClass();
        $uri = $afterbuyRequest->uri();

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

        $response = (new ReflectionClass($responseClass))->newInstance($response);
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
