<?php

declare(strict_types=1);

namespace AfterbuySdk\Request;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\RequestMethodEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Response\GetAfterbuyTimeResponse;
use RuntimeException;

final readonly class GetAfterbuyTimeRequest implements AfterbuyRequestInterface
{
    public function __construct(
        private int $detailLevel = 0,
    ) {
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(AfterbuyGlobal $afterbuyGlobal): string
    {
        $afterbuyGlobal->setCallName('GetAfterbuyTime');
        $afterbuyGlobal->setDetailLevel($this->detailLevel);

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
