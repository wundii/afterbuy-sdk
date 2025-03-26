<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopProducts;

use AfterbuySdk\Enum\DefaultFilterShopProductsEnum;
use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

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
