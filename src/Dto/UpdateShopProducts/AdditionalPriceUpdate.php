<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class AdditionalPriceUpdate implements AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private int $definitionId,
        private int $productId,
        private float $price,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $additionalPriceUpdate = $xml->addChild('AdditionalPriceUpdate');
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
