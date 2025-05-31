<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;

interface AfterbuyRequestInterface
{
    public function callName(): string;

    public function method(): RequestMethodEnum;

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): ?string;

    /**
     * @return string[]
     */
    public function query(): array;

    public function requestDto(): ?AfterbuyRequestDtoInterface;

    public function responseClass(): string;

    public function uri(EndpointEnum $endpointEnum): string;
}
