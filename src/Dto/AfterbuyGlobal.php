<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto;

use SimpleXMLElement;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\ErrorLanguageEnum;

final class AfterbuyGlobal
{
    public const DefaultXmlRoot = '<?xml version="1.0" encoding="utf-8"?><Request></Request>';

    private string $callName;

    private DetailLevelEnum $detailLevelEnum;

    public function __construct(
        private readonly string $accountToken,
        private readonly string $partnerToken,
        private readonly ErrorLanguageEnum $errorLanguageEnum = ErrorLanguageEnum::GERMAN,
    ) {
    }

    public function simpleXmlElement(SimpleXMLElement $xml): void
    {
        $afterbuyGlobal = $xml->addChild('AfterbuyGlobal');
        $afterbuyGlobal->addChild('AccountToken', $this->accountToken);
        $afterbuyGlobal->addChild('PartnerToken', $this->partnerToken);
        $afterbuyGlobal->addChild('ErrorLanguage', $this->errorLanguageEnum->value);
        $afterbuyGlobal->addChild('CallName', $this->callName);
        $afterbuyGlobal->addChild('DetailLevel', (string) $this->detailLevelEnum->value);
    }

    public function setCallName(string $callName): void
    {
        $this->callName = $callName;
    }

    public function setDetailLevelEnum(DetailLevelEnum $detailLevelEnum): void
    {
        $this->detailLevelEnum = $detailLevelEnum;
    }
}
