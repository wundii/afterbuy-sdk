<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetListerHistory;

use Wundii\AfterbuySdk\Filter\ValueFrom;
use Wundii\AfterbuySdk\Filter\ValueTo;
use Wundii\AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class RangeAnr implements GetListerHistoryFilterInterface
{
    public function __construct(
        private int $itemNumberFrom,
        private int $itemNumberTo,
    ) {
    }

    public function getFilterName(): string
    {
        return 'RangeAnr';
    }

    public function getFilterValues(): array
    {
        return [
            new ValueFrom((string) $this->itemNumberFrom),
            new ValueTo((string) $this->itemNumberTo),
        ];
    }
}
