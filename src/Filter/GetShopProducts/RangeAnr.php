<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetShopProducts;

use Wundii\AfterbuySdk\Filter\ValueFrom;
use Wundii\AfterbuySdk\Filter\ValueTo;
use Wundii\AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

final readonly class RangeAnr implements GetShopProductsFilterInterface
{
    public function __construct(
        private int $anrFrom,
        private int $anrTo,
    ) {
    }

    public function getFilterName(): string
    {
        return 'RangeAnr';
    }

    public function getFilterValues(): array
    {
        return [
            new ValueFrom((string) $this->anrFrom),
            new ValueTo((string) $this->anrTo),
        ];
    }
}
