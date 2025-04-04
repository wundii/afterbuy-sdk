<?php

declare(strict_types=1);

namespace AfterbuySdk\Request;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\UpdateShopProducts\Product;
use AfterbuySdk\Dto\UpdateShopProducts\Products;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\RequestMethodEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Response\UpdateShopProductsResponse;
use RuntimeException;

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

    public function payload(AfterbuyGlobal $afterbuyGlobal): string
    {
        $products = new Products(
            $this->products
        );

        if ($products->isValid() === false) {
            throw new RuntimeException($products->getInvalidMessage());
        }

        $afterbuyGlobal->setCallName('UpdateShopProducts');
        $afterbuyGlobal->setDetailLevelEnum(DetailLevelEnum::FIRST);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->appendContent($products);

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
