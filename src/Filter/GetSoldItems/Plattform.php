<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetSoldItems;

use Wundii\AfterbuySdk\Enum\PlattformEnum;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

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
