<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetStockInfo;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class Products implements ResponseDtoInterface
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
