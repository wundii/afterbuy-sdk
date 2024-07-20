<?php

declare(strict_types=1);

namespace AfterbuySdk\Interface;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface AfterbuyResponseInterface
{
    public function __construct(ResponseInterface $response);

    public function getStatusCode(): int;

    public function getInfo(): mixed;

    /**
     * @return string[]
     */
    public function getErrorMessages(): array;
}
