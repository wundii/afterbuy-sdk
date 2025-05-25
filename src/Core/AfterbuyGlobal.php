<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Core;

use RuntimeException;
use SimpleXMLElement;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\ErrorLanguageEnum;

final class AfterbuyGlobal
{
    public const DefaultXmlRoot = '<?xml version="1.0" encoding="utf-8"?><Request></Request>';

    private ?string $callName = null;

    /**
     * @var DetailLevelEnum[]
     */
    private array $detailLevelEnums = [];

    public function __construct(
        private readonly string $accountToken,
        private readonly string $partnerToken,
        private readonly ErrorLanguageEnum $errorLanguageEnum = ErrorLanguageEnum::GERMAN,
    ) {
    }

    public function simpleXmlElement(SimpleXMLElement $xml): void
    {
        if ($this->callName === null) {
            throw new RuntimeException('Call name must be set before generating XML');
        }

        $afterbuyGlobal = $xml->addChild('AfterbuyGlobal');
        $afterbuyGlobal->addChild('AccountToken', $this->accountToken);
        $afterbuyGlobal->addChild('PartnerToken', $this->partnerToken);
        $afterbuyGlobal->addChild('ErrorLanguage', $this->errorLanguageEnum->value);
        $afterbuyGlobal->addChild('CallName', $this->callName);
        $afterbuyGlobal->addChild('DetailLevel', $this->getDetailLevel());
    }

    public function setCallName(string $callName): void
    {
        $this->callName = $callName;
    }

    public function getDetailLevel(): string
    {
        $detailLevelEnums = $this->detailLevelEnums;

        if ($detailLevelEnums === []) {
            return (string) DetailLevelEnum::FIRST->value;
        }

        $detailLevelArray = array_map(static fn (DetailLevelEnum $detailLevelEnum): int => $detailLevelEnum->value, $this->detailLevelEnums);
        $detailLevelArray = array_unique($detailLevelArray);

        return (string) array_sum($detailLevelArray);
    }

    /**
     * @param DetailLevelEnum[] $detailLevelEnums
     */
    public function setDetailLevelEnums(array $detailLevelEnums, DetailLevelEnum $maxDetailLevelEnum): void
    {
        $filteredEnums = array_filter(
            $detailLevelEnums,
            fn (DetailLevelEnum $detailLevelEnum): bool => $detailLevelEnum->value <= $maxDetailLevelEnum->value
        );

        $this->detailLevelEnums = $filteredEnums;
    }
}
