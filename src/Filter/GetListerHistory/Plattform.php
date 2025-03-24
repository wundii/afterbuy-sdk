<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetListerHistory;

use AfterbuySdk\Enum\PlattformEnum;
use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class Plattform implements GetListerHistoryFilterInterface
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
