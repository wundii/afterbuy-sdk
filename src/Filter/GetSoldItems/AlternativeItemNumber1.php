<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetSoldItems;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class AlternativeItemNumber1 implements GetSoldItemsFilterInterface
{
    public function __construct(
        private string $alternativeItemNumber1
    ) {
    }

    public function getFilterName(): string
    {
        return 'AlternativeItemNumber1';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->alternativeItemNumber1),
        ];
    }
}
