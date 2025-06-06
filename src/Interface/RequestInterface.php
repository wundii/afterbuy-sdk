<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;

interface RequestInterface
{
    public function callName(): string;

    public function method(): RequestMethodEnum;

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): ?string;

    /**
     * @return string[]
     */
    public function query(): array;

    public function requestDto(): ?RequestDtoInterface;

    public function responseClass(): string;

    public function url(EndpointEnum $endpointEnum): string;
}
