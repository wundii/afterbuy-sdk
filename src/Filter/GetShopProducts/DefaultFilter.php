<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetShopProducts;

use Wundii\AfterbuySdk\Enum\DefaultFilterShopProductsEnum;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

final readonly class DefaultFilter implements GetShopProductsFilterInterface
{
    public function __construct(
        private DefaultFilterShopProductsEnum $defaultFilterShopProductsEnum
    ) {
    }

    public function getFilterName(): string
    {
        return 'DefaultFilter';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->defaultFilterShopProductsEnum->value),
        ];
    }
}
