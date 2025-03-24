<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopProducts;

use AfterbuySdk\Enum\DefaultFilterEnum;
use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

final readonly class DefaultFilter implements GetShopProductsFilterInterface
{
    public function __construct(
        private DefaultFilterEnum $defaultFilterEnum
    ) {
    }

    public function getFilterName(): string
    {
        return 'DefaultFilter';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->defaultFilterEnum->value),
        ];
    }
}
