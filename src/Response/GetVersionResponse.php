<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\Versions;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Wundii\DataMapper\DataMapper;

/**
 * @template-implements AfterbuyResponseInterface<Versions>
 */
final readonly class GetVersionResponse implements AfterbuyResponseInterface
{
    private string $content;

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function __construct(
        private DataMapper $dataMapper,
        private ResponseInterface $response
    ) {
        $this->content = $this->response->getContent(false);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getInfo(): mixed
    {
        return $this->response->getInfo();
    }

    /**
     * @return Versions
     */
    public function getResponse(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, Versions::class, ['Result']);
    }

    public function getErrorMessages(): array
    {
        return [];
    }
}
