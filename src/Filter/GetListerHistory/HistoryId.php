<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetListerHistory;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

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
