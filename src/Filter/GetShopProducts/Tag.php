<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopProducts;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

final readonly class Tag implements GetShopProductsFilterInterface
{
    public function __construct(
        private string $tag
    ) {
    }

    public function getFilterName(): string
    {
        return 'Tag';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->tag),
        ];
    }
}
