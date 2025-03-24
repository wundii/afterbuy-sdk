<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopProducts;

use AfterbuySdk\Filter\LevelFrom;
use AfterbuySdk\Filter\LevelTo;
use AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

final readonly class Level implements GetShopProductsFilterInterface
{
    public function __construct(
        private int $levelFrom,
        private int $levelTo,
    ) {
    }

    public function getFilterName(): string
    {
        return 'Level';
    }

    public function getFilterValues(): array
    {
        return [
            new LevelFrom((string) $this->levelFrom),
            new LevelTo((string) $this->levelTo),
        ];
    }
}
