<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetSoldItems;

use AfterbuySdk\Enum\PlattformEnum;
use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class Plattform implements GetSoldItemsFilterInterface
{
    public function __construct(
        private PlattformEnum $plattformEnum
    ) {
    }

    public function getFilterName(): string
    {
        return 'Plattform';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->plattformEnum->value),
        ];
    }
}
