<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetSoldItems;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class AlternativeItemNumber2 implements GetSoldItemsFilterInterface
{
    public function __construct(
        private string $alternativeItemNumber2
    ) {
    }

    public function getFilterName(): string
    {
        return 'AlternativeItemNumber2';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->alternativeItemNumber2),
        ];
    }
}
