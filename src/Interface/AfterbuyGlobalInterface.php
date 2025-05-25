<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use SimpleXMLElement;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;

interface AfterbuyGlobalInterface
{
    public function getDetailLevel(): string;

    public function setCallName(string $callName): void;

    /**
     * @param DetailLevelEnum[] $detailLevelEnums
     */
    public function setDetailLevelEnums(array $detailLevelEnums, DetailLevelEnum $maxDetailLevelEnum): void;

    public function simpleXmlElement(SimpleXMLElement $xml): void;
}
