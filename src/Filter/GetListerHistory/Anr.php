<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetListerHistory;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class Anr implements GetListerHistoryFilterInterface
{
    public function __construct(
        private int $itemNumber
    ) {
    }

    public function getFilterName(): string
    {
        return 'Anr';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->itemNumber),
        ];
    }
}
