<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopProducts;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

final readonly class ProductId implements GetShopProductsFilterInterface
{
    public function __construct(
        private int $productId
    ) {
    }

    public function getFilterName(): string
    {
        return 'ProductID';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->productId),
        ];
    }
}
