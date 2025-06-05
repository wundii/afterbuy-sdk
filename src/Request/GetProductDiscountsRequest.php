<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use DateTimeInterface;
use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\AfterbuySdk\Interface\RequestInterface;
use Wundii\AfterbuySdk\Response\GetProductDiscountsResponse;

final readonly class GetProductDiscountsRequest implements RequestInterface
{
    public function __construct(
        private int $shopId,
        private ?DateTimeInterface $fromModificationDate = null,
    ) {
    }

    public function callName(): string
    {
        return 'GetProductDiscounts';
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): string
    {
        $afterbuyGlobal->setPayloadEnvironments(AfterbuyApiSourceEnum::XML, $this->callName());

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->addNumber('ShopID', $this->shopId);
        $xml->addDateTime('FromModificationDate', $this->fromModificationDate);

        $string = $xml->asXML();
        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function requestDto(): ?RequestDtoXmlInterface
    {
        return null;
    }

    public function responseClass(): string
    {
        return GetProductDiscountsResponse::class;
    }

    public function url(AfterbuyEndpointEnum $afterbuyEndpointEnum): string
    {
        return $afterbuyEndpointEnum->afterbuyApiUri();
    }

    public function query(): array
    {
        return [];
    }
}
