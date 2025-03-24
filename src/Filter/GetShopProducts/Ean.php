<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopProducts;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

final readonly class Ean implements GetShopProductsFilterInterface
{
    public function __construct(
        private string $ean
    ) {
    }

    public function getFilterName(): string
    {
        return 'Ean';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->ean),
        ];
    }
}
