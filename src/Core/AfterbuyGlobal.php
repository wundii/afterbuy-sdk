<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Core;

use SimpleXMLElement;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyDetailLevelEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\AfterbuySdk\Enum\ErrorLanguageEnum;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;

final class AfterbuyGlobal implements AfterbuyGlobalInterface
{
    public const DefaultXmlRoot = '<?xml version="1.0" encoding="utf-8"?><Request></Request>';

    private string $callName = 'noCallNameSet';

    private AfterbuyApiSourceEnum $afterbuyApiSourceEnum = AfterbuyApiSourceEnum::XML;

    /**
     * @var AfterbuyDetailLevelEnum[]
     */
    private array $afterbuyDetailLevelEnums = [];

    public function __construct(
        private readonly string $accountToken,
        private readonly string $partnerToken,
        private readonly AfterbuyEndpointEnum $afterbuyEndpointEnum,
        private readonly ErrorLanguageEnum $errorLanguageEnum = ErrorLanguageEnum::GERMAN,
    ) {
    }

    public function simpleXmlElement(SimpleXMLElement $xml): void
    {
        $afterbuyGlobal = $xml->addChild('AfterbuyGlobal');

        if ($this->afterbuyEndpointEnum === AfterbuyEndpointEnum::SANDBOX) {
            $afterbuyGlobal->addChild('Sandbox', $this->afterbuyApiSourceEnum->value);
        }

        $afterbuyGlobal->addChild('AccountToken', $this->accountToken);
        $afterbuyGlobal->addChild('PartnerToken', $this->partnerToken);
        $afterbuyGlobal->addChild('ErrorLanguage', $this->errorLanguageEnum->value);
        $afterbuyGlobal->addChild('CallName', $this->callName);
        $afterbuyGlobal->addChild('DetailLevel', $this->getDetailLevel());
    }

    public function getAfterbuySandboxResponse(): AfterbuySandboxResponse
    {
        $defaultShopApiResponse = sprintf(
            '<?xml version="1.0" encoding="utf-8"?>' .
            '<result><sandbox>%s</sandbox><success>1</success><data/></result>',
            AfterbuyApiSourceEnum::SHOP->value,
        );
        $defaultXmlApiResponse = sprintf(
            '<?xml version="1.0" encoding="utf-8"?>' .
            '<Afterbuy><Sandbox>%s</Sandbox><CallStatus>Success</CallStatus><CallName>%s</CallName><VersionID>%f</VersionID></Afterbuy>',
            AfterbuyApiSourceEnum::XML->value,
            htmlspecialchars($this->callName, ENT_XML1),
            Afterbuy::DefaultSandboxVersion
        );

        $defaultResponse = $defaultXmlApiResponse;

        if ($this->afterbuyApiSourceEnum === AfterbuyApiSourceEnum::SHOP) {
            $defaultResponse = $defaultShopApiResponse;
        }

        return new AfterbuySandboxResponse($defaultResponse);
    }

    public function getDetailLevel(): string
    {
        $afterbuyDetailLevelEnums = $this->afterbuyDetailLevelEnums;

        if ($afterbuyDetailLevelEnums === []) {
            return (string) AfterbuyDetailLevelEnum::FIRST->value;
        }

        $afterbuyDetailLevelArray = array_map(static fn (AfterbuyDetailLevelEnum $AfterbuyDetailLevelEnum): int => $AfterbuyDetailLevelEnum->value, $this->afterbuyDetailLevelEnums);
        $afterbuyDetailLevelArray = array_unique($afterbuyDetailLevelArray);

        return (string) array_sum($afterbuyDetailLevelArray);
    }

    public function getEndpointEnum(): AfterbuyEndpointEnum
    {
        return $this->afterbuyEndpointEnum;
    }

    /**
     * @param AfterbuyDetailLevelEnum[] $afterbuyDetailLevelEnum
     */
    public function setDetailLevelEnum(AfterbuyDetailLevelEnum|array $afterbuyDetailLevelEnum, AfterbuyDetailLevelEnum $maxAfterbuyDetailLevelEnum): void
    {
        if ($afterbuyDetailLevelEnum instanceof AfterbuyDetailLevelEnum) {
            $afterbuyDetailLevelEnum = [$afterbuyDetailLevelEnum];
        }

        $filteredEnums = array_filter(
            $afterbuyDetailLevelEnum,
            fn (AfterbuyDetailLevelEnum $afterbuyDetailLevelEnum): bool => $afterbuyDetailLevelEnum->value <= $maxAfterbuyDetailLevelEnum->value
        );

        $this->afterbuyDetailLevelEnums = $filteredEnums;
    }

    public function setPayloadEnvironments(AfterbuyApiSourceEnum $afterbuyApiSourceEnum, string $callName): void
    {
        $this->callName = $callName;
        $this->afterbuyApiSourceEnum = $afterbuyApiSourceEnum;
    }
}
