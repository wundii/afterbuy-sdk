<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetShopCatalogs;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetShopCatalogsFilterInterface;

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
