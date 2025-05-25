<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
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
     * @var DetailLevelEnum[]
     */
    private array $detailLevelEnums;

    /**
     * @param GetShopProductsFilterInterface[] $filter
     */
    public function __construct(
        private array $filter = [],
        private int $maxShopItems = 100,
        private bool $suppressBaseProductRelatedData = false,
        private bool $paginationEnabled = false,
        private ?int $pageNumber = null,
        private bool $returnShop20Container = false,
        DetailLevelEnum ...$detailLevelEnum,
    ) {
        $this->detailLevelEnums = $detailLevelEnum;
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
        $maxShopItems = $this->maxShopItems;
        if ($maxShopItems > 250) {
            $maxShopItems = 250;
        }

        $detailLevelEnums = array_filter(
            $this->detailLevelEnums,
            static fn (DetailLevelEnum $detailLevelEnum): bool => $detailLevelEnum !== DetailLevelEnum::SIXTH
        );

        $afterbuyGlobal->setCallName('GetShopProducts');
        $afterbuyGlobal->setDetailLevelEnums($detailLevelEnums, DetailLevelEnum::EIGHTH);

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
