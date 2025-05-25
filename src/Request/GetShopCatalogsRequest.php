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
use Wundii\AfterbuySdk\Interface\Filter\GetShopCatalogsFilterInterface;
use Wundii\AfterbuySdk\Response\GetShopCatalogsResponse;

final readonly class GetShopCatalogsRequest implements AfterbuyRequestInterface
{
    /**
     * @var DetailLevelEnum[]
     */
    private array $detailLevelEnums;

    /**
     * @param GetShopCatalogsFilterInterface[] $filter
     */
    public function __construct(
        private array $filter = [],
        private int $maxCatalogs = 100,
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
        $afterbuyGlobal->setCallName('GetShopCatalogs');
        $afterbuyGlobal->setDetailLevelEnums($this->detailLevelEnums, DetailLevelEnum::SECOND);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->addNumber('MaxCatalogs', $this->maxCatalogs);
        $xml->addFilter($this->filter);

        $string = $xml->asXML();
        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function responseClass(): string
    {
        return GetShopCatalogsResponse::class;
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
