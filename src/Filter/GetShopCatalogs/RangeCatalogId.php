<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetShopCatalogs;

use Wundii\AfterbuySdk\Filter\ValueFrom;
use Wundii\AfterbuySdk\Filter\ValueTo;
use Wundii\AfterbuySdk\Interface\Filter\GetShopCatalogsFilterInterface;

final readonly class RangeCatalogId implements GetShopCatalogsFilterInterface
{
    public function __construct(
        private int $catalogIdFrom,
        private int $catalogIdTo,
    ) {
    }

    public function getFilterName(): string
    {
        return 'RangeID';
    }

    public function getFilterValues(): array
    {
        return [
            new ValueFrom((string) $this->catalogIdFrom),
            new ValueTo((string) $this->catalogIdTo),
        ];
    }
}
