<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use DateTimeInterface;
use RuntimeException;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestInterface;
use Wundii\AfterbuySdk\Response\GetProductDiscountsResponse;

final readonly class GetProductDiscountsRequest implements AfterbuyRequestInterface
{
    public function __construct(
        private int $shopId,
        private ?DateTimeInterface $fromModificationDate = null,
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

        $afterbuyGlobal->setCallName('GetProductDiscounts');
        $afterbuyGlobal->setDetailLevelEnum(DetailLevelEnum::FIRST);

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

    public function responseClass(): string
    {
        return GetProductDiscountsResponse::class;
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
