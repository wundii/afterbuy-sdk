<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestInterface;
use Wundii\AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;
use Wundii\AfterbuySdk\Response\GetShopProductsResponse;

final readonly class GetShopProductsRequest implements AfterbuyRequestInterface
{
    /**
     * @param GetShopProductsFilterInterface[] $filter
     */
    public function __construct(
        private DetailLevelEnum $detailLevelEnum = DetailLevelEnum::FIRST,
        private int $maxShopItems = 100,
        private bool $suppressBaseProductRelatedData = false,
        private bool $paginationEnabled = false,
        private ?int $pageNumber = null,
        private bool $returnShop20Container = false,
        private array $filter = [],
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
            DetailLevelEnum::THIRD,
            DetailLevelEnum::FOURTH,
            DetailLevelEnum::FIFTH,
            DetailLevelEnum::SEVENTH,
            DetailLevelEnum::EIGHTH => $this->detailLevelEnum,
            default => DetailLevelEnum::FIRST,
        };

        $maxShopItems = $this->maxShopItems;
        if ($maxShopItems > 250) {
            $maxShopItems = 250;
        }

        $afterbuyGlobal->setCallName('GetShopProducts');
        $afterbuyGlobal->setDetailLevelEnum($detailLevelEnum);

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

    public function responseClass(): string
    {
        return GetShopProductsResponse::class;
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
