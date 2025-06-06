<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use SimpleXMLElement;
use Wundii\AfterbuySdk\Core\SandboxResponse;
use Wundii\AfterbuySdk\Enum\Core\ApiSourceEnum;
use Wundii\AfterbuySdk\Enum\Core\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;

interface AfterbuyGlobalInterface
{
    public function getSandboxResponse(): SandboxResponse;

    public function getDetailLevel(): string;

    public function getEndpointEnum(): EndpointEnum;

    /**
     * @param DetailLevelEnum[] $detailLevelEnum
     */
    public function setDetailLevelEnum(DetailLevelEnum|array $detailLevelEnum, DetailLevelEnum $maxDetailLevelEnum): void;

    public function setPayloadEnvironments(ApiSourceEnum $apiSourceEnum, string $callName): void;

    public function simpleXmlElement(SimpleXMLElement $xml): void;
}
