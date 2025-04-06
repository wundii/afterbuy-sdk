<?php

declare(strict_types=1);

namespace AfterbuySdk\Interface;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\RequestMethodEnum;

interface AfterbuyRequestInterface
{
    public function method(): RequestMethodEnum;

    public function payload(AfterbuyGlobal $afterbuyGlobal): string;

    public function responseClass(): string;

    public function uri(EndpointEnum $endpointEnum): string;

    /**
     * @return string[]
     */
    public function query(): array;

    public function requestClass(): ?AfterbuyAppendXmlContentInterface;
}
