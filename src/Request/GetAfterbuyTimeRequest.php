<?php

declare(strict_types=1);

namespace AfterbuySdk\Request;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\RequestMethodEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Response\GetAfterbuyTimeResponse;
use RuntimeException;

final readonly class GetAfterbuyTimeRequest implements AfterbuyRequestInterface
{
    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(AfterbuyGlobal $afterbuyGlobal): string
    {
        $afterbuyGlobal->setCallName('GetAfterbuyTime');
        $afterbuyGlobal->setDetailLevelEnum(DetailLevelEnum::FIRST); // only first level is allowed

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
        return GetAfterbuyTimeResponse::class;
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
