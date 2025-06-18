<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Core;

use SimpleXMLElement;
use Wundii\AfterbuySdk\Enum\Core\ApiSourceEnum;
use Wundii\AfterbuySdk\Enum\Core\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\ErrorLanguageEnum;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;

final class AfterbuyGlobal implements AfterbuyGlobalInterface
{
    public const DefaultXmlRoot = '<?xml version="1.0" encoding="utf-8"?><Request></Request>';

    private string $callName = 'noCallNameSet';

    private ApiSourceEnum $apiSourceEnum = ApiSourceEnum::XML;

    /**
     * @var DetailLevelEnum[]
     */
    private array $detailLevelEnums = [];

    public function __construct(
        private readonly string $accountToken,
        private readonly string $partnerToken,
        private readonly EndpointEnum $endpointEnum,
        private readonly ErrorLanguageEnum $errorLanguageEnum = ErrorLanguageEnum::GERMAN,
    ) {
    }

    public function simpleXmlElement(SimpleXMLElement $xml): void
    {
        $afterbuyGlobal = $xml->addChild('AfterbuyGlobal');

        if ($this->endpointEnum === EndpointEnum::SANDBOX) {
            $afterbuyGlobal->addChild('Sandbox', $this->apiSourceEnum->value);
        }

        $afterbuyGlobal->addChild('AccountToken', $this->accountToken);
        $afterbuyGlobal->addChild('PartnerToken', $this->partnerToken);
        $afterbuyGlobal->addChild('ErrorLanguage', $this->errorLanguageEnum->value);
        $afterbuyGlobal->addChild('CallName', $this->callName);
        $afterbuyGlobal->addChild('DetailLevel', $this->getDetailLevel());
    }

    public function getSandboxResponse(): SandboxResponse
    {
        $defaultShopApiResponse = sprintf(
            '<?xml version="1.0" encoding="utf-8"?>' .
            '<result><sandbox>%s</sandbox><success>1</success><data/></result>',
            ApiSourceEnum::SHOP->value,
        );
        $defaultXmlApiResponse = sprintf(
            '<?xml version="1.0" encoding="utf-8"?>' .
            '<Afterbuy><Sandbox>%s</Sandbox><CallStatus>Success</CallStatus><CallName>%s</CallName><VersionID>%f</VersionID></Afterbuy>',
            ApiSourceEnum::XML->value,
            htmlspecialchars($this->callName, ENT_XML1),
            Afterbuy::DefaultSandboxVersion
        );

        $defaultResponse = $defaultXmlApiResponse;

        if ($this->apiSourceEnum === ApiSourceEnum::SHOP) {
            $defaultResponse = $defaultShopApiResponse;
        }

        return new SandboxResponse($defaultResponse);
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

    public function getEndpointEnum(): EndpointEnum
    {
        return $this->endpointEnum;
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

    public function setPayloadEnvironments(ApiSourceEnum $apiSourceEnum, string $callName): void
    {
        $this->callName = $callName;
        $this->apiSourceEnum = $apiSourceEnum;
    }
}
