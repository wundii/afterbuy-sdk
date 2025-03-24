<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopCatalogs;

use AfterbuySdk\Filter\ValueFrom;
use AfterbuySdk\Filter\ValueTo;
use AfterbuySdk\Interface\Filter\GetShopCatalogsFilterInterface;

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
