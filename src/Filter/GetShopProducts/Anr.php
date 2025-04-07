<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetShopProducts;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

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
