<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetStockInfo;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class Products implements AfterbuyDtoInterface
{
    /**
     * @param Product[] $products
     */
    public function __construct(
        private array $products = [],
    ) {
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts(array $products): void
    {
        $this->products = $products;
    }
}
