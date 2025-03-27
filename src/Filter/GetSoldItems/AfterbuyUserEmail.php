<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetSoldItems;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class AfterbuyUserEmail implements GetSoldItemsFilterInterface
{
    public function __construct(
        private string $afterbuyUserEmail
    ) {
    }

    public function getFilterName(): string
    {
        return 'AfterbuyUserEmail';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->afterbuyUserEmail),
        ];
    }
}
