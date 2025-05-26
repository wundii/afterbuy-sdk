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
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestInterface;
use Wundii\AfterbuySdk\Interface\Filter\GetStockInfoFilterInterface;
use Wundii\AfterbuySdk\Response\GetStockInfoResponse;

final readonly class GetStockInfoRequest implements AfterbuyRequestInterface
{
    /**
     * @param GetStockInfoFilterInterface[] $productFilter
     * @param DetailLevelEnum[] $detailLevelEnum empty array === first detail level
     */
    public function __construct(
        private array $productFilter = [],
        private DetailLevelEnum|array $detailLevelEnum = DetailLevelEnum::FIRST,
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

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): string
    {
        if ($this->productFilter === []) {
            throw new RuntimeException('ProductFilter is required');
        }

        $afterbuyGlobal->setCallName('GetStockInfo');
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

    public function responseClass(): string
    {
        return GetStockInfoResponse::class;
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
