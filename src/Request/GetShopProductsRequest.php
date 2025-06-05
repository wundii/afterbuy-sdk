<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\AfterbuySdk\Interface\RequestInterface;
use Wundii\AfterbuySdk\Response\GetShopProductsResponse;

final readonly class GetShopProductsRequest implements RequestInterface
{
    /**
     * @param GetShopProductsFilterInterface[] $filter
     * @param DetailLevelEnum[] $detailLevelEnum empty array === first detail level
     */
    public function __construct(
        private array $filter = [],
        private int $maxShopItems = 100,
        private bool $suppressBaseProductRelatedData = false,
        private bool $paginationEnabled = false,
        private ?int $pageNumber = null,
        private bool $returnShop20Container = false,
        private DetailLevelEnum|array $detailLevelEnum = DetailLevelEnum::FIRST,
    ) {
    }

    public function callName(): string
    {
        return 'GetShopProducts';
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): string
    {
        $maxShopItems = $this->maxShopItems;
        if ($maxShopItems > 250) {
            $maxShopItems = 250;
        }

        $detailLevelEnum = $this->detailLevelEnum;
        if ($detailLevelEnum instanceof DetailLevelEnum) {
            $detailLevelEnum = [$detailLevelEnum];
        }

        $detailLevelEnum = array_filter(
            $detailLevelEnum,
            static fn (DetailLevelEnum $detailLevelEnum): bool => $detailLevelEnum !== DetailLevelEnum::SIXTH
        );

        $afterbuyGlobal->setPayloadEnvironments(AfterbuyApiSourceEnum::XML, $this->callName());
        $afterbuyGlobal->setDetailLevelEnum($detailLevelEnum, DetailLevelEnum::EIGHTH);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->addNumber('MaxShopItems', $maxShopItems);
        $xml->addNumber('SuppressBaseProductRelatedData', (int) $this->suppressBaseProductRelatedData);
        $xml->addNumber('PaginationEnabled', $this->paginationEnabled ? 1 : null);
        $xml->addNumber('PageNumber', $this->pageNumber);
        $xml->addNumber('ReturnShop20Container', $this->returnShop20Container ? 1 : null);
        $xml->addFilter($this->filter);

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
        return GetShopProductsResponse::class;
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
