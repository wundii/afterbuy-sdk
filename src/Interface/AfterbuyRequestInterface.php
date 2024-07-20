<?php

declare(strict_types=1);

namespace AfterbuySdk\Interface;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\RequestMethodEnum;

interface AfterbuyRequestInterface
{
    public function __construct(AfterbuyGlobal $afterbuyGlobal);

    public function method(): RequestMethodEnum;

    public function payload(): string;

    public function responseClass(): string;

    public function uri(): string;

    /**
     * @return string[]
     */
    public function query(): array;
}
