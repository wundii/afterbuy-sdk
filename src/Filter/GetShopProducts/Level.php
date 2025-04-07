<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetShopProducts;

use Wundii\AfterbuySdk\Filter\LevelFrom;
use Wundii\AfterbuySdk\Filter\LevelTo;
use Wundii\AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

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
