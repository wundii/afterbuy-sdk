<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class Products implements AfterbuyAppendXmlContentInterface
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

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $products = $xml->addChild('Products');

        foreach ($this->products as $product) {
            $product->appendXmlContent($products);
        }
    }
}
