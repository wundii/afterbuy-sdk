<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopProducts;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

final readonly class Anr implements GetShopProductsFilterInterface
{
    public function __construct(
        private int $anr
    ) {
    }

    public function getFilterName(): string
    {
        return 'Anr';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->anr),
        ];
    }
}
