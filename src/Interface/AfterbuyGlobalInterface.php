<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use SimpleXMLElement;
use Wundii\AfterbuySdk\Core\AfterbuySandboxResponse;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyDetailLevelEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;

interface AfterbuyGlobalInterface
{
    public function getAfterbuySandboxResponse(): AfterbuySandboxResponse;

    public function getDetailLevel(): string;

    public function getEndpointEnum(): AfterbuyEndpointEnum;

    /**
     * @param AfterbuyDetailLevelEnum[] $afterbuyDetailLevelEnum
     */
    public function setDetailLevelEnum(AfterbuyDetailLevelEnum|array $afterbuyDetailLevelEnum, AfterbuyDetailLevelEnum $maxAfterbuyDetailLevelEnum): void;

    public function setPayloadEnvironments(AfterbuyApiSourceEnum $afterbuyApiSourceEnum, string $callName): void;

    public function simpleXmlElement(SimpleXMLElement $xml): void;
}
