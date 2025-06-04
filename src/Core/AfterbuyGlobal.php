<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Core;

use RuntimeException;
use SimpleXMLElement;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\ErrorLanguageEnum;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;

final class AfterbuyGlobal implements AfterbuyGlobalInterface
{
    public const DefaultXmlRoot = '<?xml version="1.0" encoding="utf-8"?><Request></Request>';

    private ?string $callName = null;

    private ?EndpointEnum $endpointEnum = null;

    private ?AfterbuyApiSourceEnum $afterbuyApiSourceEnum = null;

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

        if (! $this->endpointEnum instanceof EndpointEnum) {
            throw new RuntimeException('Endpoint must be set before generating XML');
        }

        if (! $this->afterbuyApiSourceEnum instanceof AfterbuyApiSourceEnum) {
            throw new RuntimeException('Afterbuy API source must be set before generating XML');
        }

        $afterbuyGlobal = $xml->addChild('AfterbuyGlobal');

        if ($this->endpointEnum === EndpointEnum::SANDBOX) {
            $afterbuyGlobal->addChild('Sandbox', $this->afterbuyApiSourceEnum->value);
        }

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

    public function setEndpointEnum(EndpointEnum $endpointEnum): void
    {
        $this->endpointEnum = $endpointEnum;
    }

    public function setAfterbuyApiSourceEnum(AfterbuyApiSourceEnum $afterbuyApiSourceEnum): void
    {
        $this->afterbuyApiSourceEnum = $afterbuyApiSourceEnum;
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
     * @param DetailLevelEnum[] $detailLevelEnum
     */
    public function setDetailLevelEnum(DetailLevelEnum|array $detailLevelEnum, DetailLevelEnum $maxDetailLevelEnum): void
    {
        if ($detailLevelEnum instanceof DetailLevelEnum) {
            $detailLevelEnum = [$detailLevelEnum];
        }

        $filteredEnums = array_filter(
            $detailLevelEnum,
            fn (DetailLevelEnum $detailLevelEnum): bool => $detailLevelEnum->value <= $maxDetailLevelEnum->value
        );

        $this->detailLevelEnums = $filteredEnums;
    }
}
