<?php

declare(strict_types=1);

namespace AfterbuySdk\Interface;

use AfterbuySdk\Dto\AfterbuyError;
use AfterbuySdk\Dto\AfterbuyWarning;
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
     * @return AfterbuyError[]
     */
    public function getErrorMessages(): array;

    /**
     * @return AfterbuyWarning[]
     */
    public function getWarningMessages(): array;

    public function getResponse(): ?AfterbuyDtoInterface;

    public function getXmlResponse(): string;
}
