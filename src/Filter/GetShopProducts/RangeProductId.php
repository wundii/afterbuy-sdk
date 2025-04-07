<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetShopProducts;

use Wundii\AfterbuySdk\Filter\ValueFrom;
use Wundii\AfterbuySdk\Filter\ValueTo;
use Wundii\AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

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
