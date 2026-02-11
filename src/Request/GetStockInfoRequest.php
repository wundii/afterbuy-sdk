<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\Core\ApiSourceEnum;
use Wundii\AfterbuySdk\Enum\Core\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\Filter\GetStockInfoFilterInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\AfterbuySdk\Interface\RequestInterface;
use Wundii\AfterbuySdk\Response\GetStockInfoResponse;

final readonly class GetStockInfoRequest implements RequestInterface
{
    /**
     * @param GetStockInfoFilterInterface[] $productFilter
     * @param DetailLevelEnum[] $detailLevelEnum empty array === first detail level
     */
    public function __construct(
        private array $productFilter = [],
        private DetailLevelEnum|array $detailLevelEnum = DetailLevelEnum::FIRST,
        private DateTime $time = new DateTime('now'),
    ) {
    }

    public function callName(): string
    {
        return 'GetStockInfo';
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): string
    {
        if ($this->productFilter === []) {
            throw new RuntimeException('ProductFilter is required');
        }

        if (count($this->productFilter) > 500) {
            throw new RuntimeException('Maximum of 500 ProductFilter allowed');
        }

        if ($this->time->format('H') >= 10 && $this->time->format('H') < 15 && count($this->productFilter) > 200) {
            throw new RuntimeException('From 10:00 to 15:00 (daily), the request limit is reduced to 200 products');
        }

        $afterbuyGlobal->setPayloadEnvironments(ApiSourceEnum::XML, $this->callName());
        $afterbuyGlobal->setDetailLevelEnum($this->detailLevelEnum, DetailLevelEnum::FOURTH);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->addProductFilter($this->productFilter);

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
        return GetStockInfoResponse::class;
    }

    public function url(EndpointEnum $endpointEnum): string
    {
        return $endpointEnum->afterbuyApiUri();
    }

    public function query(): array
    {
        return [];
    }
}
