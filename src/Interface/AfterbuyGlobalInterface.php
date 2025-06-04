<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use SimpleXMLElement;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;

interface AfterbuyGlobalInterface
{
    public function getDetailLevel(): string;

    public function setCallName(string $callName): void;

    public function setEndpointEnum(EndpointEnum $endpointEnum): void;

    public function setAfterbuyApiSourceEnum(AfterbuyApiSourceEnum $afterbuyApiSourceEnum): void;

    /**
     * @param DetailLevelEnum[] $detailLevelEnum
     */
    public function setDetailLevelEnum(DetailLevelEnum|array $detailLevelEnum, DetailLevelEnum $maxDetailLevelEnum): void;

    public function simpleXmlElement(SimpleXMLElement $xml): void;
}
