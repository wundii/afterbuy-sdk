<?php

declare(strict_types=1);

namespace AfterbuySdk\Interface;

use Symfony\Contracts\HttpClient\ResponseInterface;
use Wundii\DataMapper\DataMapper;

/**
 * @template T of object
 */
interface AfterbuyResponseInterface
{
    /**
     * @param DataMapper<T> $dataMapper
     */
    public function __construct(DataMapper $dataMapper, ResponseInterface $response);

    public function getStatusCode(): int;

    public function getInfo(): mixed;

    /**
     * @return string[]
     */
    public function getErrorMessages(): array;

    public function getResponse(): AfterbuyDtoInterface;
}
