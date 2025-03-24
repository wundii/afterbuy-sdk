<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopCatalogs;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetShopCatalogsFilterInterface;

final readonly class CatalogId implements GetShopCatalogsFilterInterface
{
    public function __construct(
        private int $catalogId
    ) {
    }

    public function getFilterName(): string
    {
        return 'CatalogID';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->catalogId),
        ];
    }
}
