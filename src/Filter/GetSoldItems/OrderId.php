<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetSoldItems;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class OrderId implements GetSoldItemsFilterInterface
{
    public function __construct(
        private int $orderId
    ) {
    }

    public function getFilterName(): string
    {
        return 'OrderID';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->orderId),
        ];
    }
}
