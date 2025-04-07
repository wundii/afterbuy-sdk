<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

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
