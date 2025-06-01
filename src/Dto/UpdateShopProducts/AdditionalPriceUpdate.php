<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class AdditionalPriceUpdate implements RequestDtoXmlInterface
{
    public function __construct(
        private int $definitionId,
        private int $productId,
        private float $price,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $additionalPriceUpdate = $simpleXml->addChild('AdditionalPriceUpdate');
        $additionalPriceUpdate->addNumber('DefinitionID', $this->definitionId);
        $additionalPriceUpdate->addNumber('ProductID', $this->productId);
        $additionalPriceUpdate->addNumber('Price', $this->price);
    }

    public function getDefinitionId(): int
    {
        return $this->definitionId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}
