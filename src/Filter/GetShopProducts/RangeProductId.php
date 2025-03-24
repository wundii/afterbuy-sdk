<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopProducts;

use AfterbuySdk\Filter\ValueFrom;
use AfterbuySdk\Filter\ValueTo;
use AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

final readonly class RangeProductId implements GetShopProductsFilterInterface
{
    public function __construct(
        private int $productIdFrom,
        private int $productIdTo,
    ) {
    }

    public function getFilterName(): string
    {
        return 'RangeID';
    }

    public function getFilterValues(): array
    {
        return [
            new ValueFrom((string) $this->productIdFrom),
            new ValueTo((string) $this->productIdTo),
        ];
    }
}
