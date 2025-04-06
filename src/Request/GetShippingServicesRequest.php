<?php

declare(strict_types=1);

namespace AfterbuySdk\Request;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\RequestMethodEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Response\GetShippingServicesResponse;
use RuntimeException;

final readonly class GetShippingServicesRequest implements AfterbuyRequestInterface
{
    public function __construct(
        private DetailLevelEnum $detailLevelEnum = DetailLevelEnum::FIRST,
    ) {
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function requestClass(): ?AfterbuyAppendXmlContentInterface
    {
        return null;
    }

    public function payload(AfterbuyGlobal $afterbuyGlobal): string
    {
        $detailLevelEnum = match ($this->detailLevelEnum) {
            DetailLevelEnum::FIRST,
            DetailLevelEnum::SECOND,
            DetailLevelEnum::THIRD => $this->detailLevelEnum,
            default => DetailLevelEnum::FIRST,
        };

        $afterbuyGlobal->setCallName('GetShippingServices');
        $afterbuyGlobal->setDetailLevelEnum($detailLevelEnum);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);

        $string = $xml->asXML();
        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function responseClass(): string
    {
        return GetShippingServicesResponse::class;
    }

    public function uri(EndpointEnum $endpointEnum): string
    {
        return $endpointEnum->value;
    }

    public function query(): array
    {
        return [];
    }
}
