<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of payment services.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
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
