<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetShopProducts;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

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
