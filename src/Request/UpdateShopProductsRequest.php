<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Product;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Products;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestInterface;
use Wundii\AfterbuySdk\Response\UpdateShopProductsResponse;

final readonly class UpdateShopProductsRequest implements AfterbuyRequestInterface
{
    /**
     * @param Product[] $products
     */
    public function __construct(
        private array $products = [],
    ) {
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::POST;
    }

    public function requestClass(): AfterbuyAppendXmlContentInterface
    {
        return new Products(
            $this->products
        );
    }

    public function payload(AfterbuyGlobal $afterbuyGlobal): string
    {
        $afterbuyGlobal->setCallName('UpdateShopProducts');
        $afterbuyGlobal->setDetailLevelEnum(DetailLevelEnum::FIRST);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->appendContent($this->requestClass());

        $string = $xml->asXML();
        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function responseClass(): string
    {
        return UpdateShopProductsResponse::class;
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
