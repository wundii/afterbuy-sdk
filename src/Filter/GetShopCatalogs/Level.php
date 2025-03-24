<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopCatalogs;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetShopCatalogsFilterInterface;

final readonly class Level implements GetShopCatalogsFilterInterface
{
    public function __construct(
        private int $level
    ) {
    }

    public function getFilterName(): string
    {
        return 'Level';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->level),
        ];
    }
}
