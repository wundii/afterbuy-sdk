<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final class Products implements RequestDtoXmlInterface
{
    /**
     * @param Product[] $products
     */
    public function __construct(
        private readonly array $products = [],
    ) {
    }

    /**
     * @return Product[]
     */
    #[Assert\Count(min: 1, max: 250)]
    #[Assert\Valid]
    public function getProducts(): array
    {
        return $this->products;
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $products = $simpleXml->addChild('Products');

        foreach ($this->products as $product) {
            $product->appendXmlContent($products);
        }
    }
}
