<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetSoldItems;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class AfterbuyUserId implements GetSoldItemsFilterInterface
{
    public function __construct(
        private int $afterbuyUserId
    ) {
    }

    public function getFilterName(): string
    {
        return 'AfterbuyUserID';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->afterbuyUserId),
        ];
    }
}
