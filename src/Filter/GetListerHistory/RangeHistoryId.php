<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetListerHistory;

use Wundii\AfterbuySdk\Filter\ValueFrom;
use Wundii\AfterbuySdk\Filter\ValueTo;
use Wundii\AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

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
