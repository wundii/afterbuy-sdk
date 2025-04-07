<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetSoldItems;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class ShopId implements GetSoldItemsFilterInterface
{
    public function __construct(
        private int $shopId
    ) {
    }

    public function getFilterName(): string
    {
        return 'ShopId';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->shopId),
        ];
    }
}
