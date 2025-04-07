<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use Symfony\Contracts\HttpClient\ResponseInterface;
use Wundii\AfterbuySdk\Dto\AfterbuyError;
use Wundii\AfterbuySdk\Dto\AfterbuyWarning;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
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

    public function getCallStatus(): CallStatusEnum;

    public function getInfo(): mixed;

    /**
     * @return AfterbuyError[]
     */
    public function getErrorMessages(): array;

    /**
     * @return AfterbuyWarning[]
     */
    public function getWarningMessages(): array;

    public function getResult(): ?AfterbuyDtoInterface;

    public function getXmlResponse(): string;
}
