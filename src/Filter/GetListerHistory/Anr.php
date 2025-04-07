<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetListerHistory;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

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
