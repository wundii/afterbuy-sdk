<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetListerHistory;

use AfterbuySdk\Filter\ValueFrom;
use AfterbuySdk\Filter\ValueTo;
use AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class RangeHistoryId implements GetListerHistoryFilterInterface
{
    public function __construct(
        private int $historyIdFrom,
        private int $historyIdTo,
    ) {
    }

    public function getFilterName(): string
    {
        return 'RangeID';
    }

    public function getFilterValues(): array
    {
        return [
            new ValueFrom((string) $this->historyIdFrom),
            new ValueTo((string) $this->historyIdTo),
        ];
    }
}
