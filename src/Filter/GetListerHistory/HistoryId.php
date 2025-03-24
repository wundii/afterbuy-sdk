<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetListerHistory;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class HistoryId implements GetListerHistoryFilterInterface
{
    public function __construct(
        private int $historyId
    ) {
    }

    public function getFilterName(): string
    {
        return 'HistoryID';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->historyId),
        ];
    }
}
