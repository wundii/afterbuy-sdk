<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingInfo;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestInterface;
use Wundii\AfterbuySdk\Response\GetShippingCostResponse;

final readonly class GetShippingCostRequest implements AfterbuyRequestInterface
{
    public function __construct(
        private ShippingInfo $shippingInfo,
    ) {
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function callName(): string
    {
        return 'GetShippingCost';
    }

    public function requestClass(): ?AfterbuyAppendXmlContentInterface
    {
        return null;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): string
    {
        $afterbuyGlobal->setCallName($this->callName());

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->appendContent($this->shippingInfo);

        $string = $xml->asXML();
        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function responseClass(): string
    {
        return GetShippingCostResponse::class;
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
