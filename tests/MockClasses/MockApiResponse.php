<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\MockClasses;

use Symfony\Contracts\HttpClient\ResponseInterface;

class MockApiResponse implements ResponseInterface
{
    /**
     * @param array<string,string> $headers
     */
    public function __construct(
        private string $content,
        private int $statusCode = 200,
        private array $headers = [],
    ) {
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array<string,string>
     */
    /* @phpstan-ignore-next-line */
    public function getHeaders(bool $throw = true): array
    {
        return $this->headers;
    }

    public function getContent(bool $throw = true): string
    {
        return $this->content;
    }

    /**
     * @return array<mixed>
     */
    public function toArray(bool $throw = true): array
    {
        return [];
    }

    public function cancel(): void
    {
    }

    public function getInfo(string $type = null): mixed
    {
        return null;
    }
}
