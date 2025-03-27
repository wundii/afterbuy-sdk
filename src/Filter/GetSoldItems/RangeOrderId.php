<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetSoldItems;

use AfterbuySdk\Filter\ValueFrom;
use AfterbuySdk\Filter\ValueTo;
use AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class RangeOrderId implements GetSoldItemsFilterInterface
{
    public function __construct(
        private int $orderIdFrom,
        private int $orderIdTo,
    ) {
    }

    public function getFilterName(): string
    {
        return 'RangeID';
    }

    public function getFilterValues(): array
    {
        return [
            new ValueFrom((string) $this->orderIdFrom),
            new ValueTo((string) $this->orderIdTo),
        ];
    }
}
