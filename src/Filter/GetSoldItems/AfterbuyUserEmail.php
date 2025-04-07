<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetSoldItems;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class AfterbuyUserEmail implements GetSoldItemsFilterInterface
{
    public function __construct(
        private string $afterbuyUserEmail
    ) {
    }

    public function getFilterName(): string
    {
        return 'AfterbuyUserEmail';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->afterbuyUserEmail),
        ];
    }
}
