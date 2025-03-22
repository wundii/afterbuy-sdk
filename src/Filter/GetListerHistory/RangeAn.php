<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetListerHistory;

use AfterbuySdk\Filter\ValueFrom;
use AfterbuySdk\Filter\ValueTo;
use AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class RangeAn implements GetListerHistoryFilterInterface
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
