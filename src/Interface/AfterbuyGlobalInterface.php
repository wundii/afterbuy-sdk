<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use SimpleXMLElement;
use Wundii\AfterbuySdk\Core\AfterbuySandboxResponse;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;

interface AfterbuyGlobalInterface
{
    public function getAfterbuySandboxResponse(): AfterbuySandboxResponse;

    public function getDetailLevel(): string;

    public function getEndpointEnum(): EndpointEnum;

    /**
     * @param DetailLevelEnum[] $detailLevelEnum
     */
    public function setDetailLevelEnum(DetailLevelEnum|array $detailLevelEnum, DetailLevelEnum $maxDetailLevelEnum): void;

    public function setPayloadEnvironments(AfterbuyApiSourceEnum $afterbuyApiSourceEnum, string $callName): void;

    public function simpleXmlElement(SimpleXMLElement $xml): void;
}
