<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Exception;

final class Products implements AfterbuyAppendXmlContentInterface
{
    private string $invalidMessage = 'Is valid was not called';

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
    public function getProducts(): array
    {
        return $this->products;
    }

    public function isValid(): bool
    {
        $deepProduct = function (Product $product) use (&$productCount): void {
            ++$productCount;
            if ($productCount > 250) {
                throw new Exception('Products can not contain more than 250 products');
            }

            if ($product->getSkus() instanceof Skus && count($product->getSkus()->getSkus()) > 10) {
                throw new Exception('Products can not contain more than 10 skus');
            }

            if (count($product->getAdditionalDescriptionFields()) > 10) {
                throw new Exception('Products can not contain more than 10 additional description fields');
            }
        };

        try {
            $productCount = 0;
            foreach ($this->products as $product) {
                $deepProduct($product);
            }
        } catch (Exception $exception) {
            $this->invalidMessage = $exception->getMessage();

            return false;
        }

        return true;
    }

    public function getInvalidMessage(): string
    {
        return $this->invalidMessage;
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $products = $xml->addChild('Products');

        foreach ($this->products as $product) {
            $product->appendXmlContent($products);
        }
    }
}
