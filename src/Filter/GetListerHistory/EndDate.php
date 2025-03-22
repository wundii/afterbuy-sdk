<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetListerHistory;

use AfterbuySdk\Filter\DateFrom;
use AfterbuySdk\Filter\DateTo;
use AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class EndDate implements GetShopCatalogsFilterInterface
{
    public function __construct(
        private string $dateFrom,
        private string $dateTo ,
    ) {
    }

    public function getFilterName(): string
    {
        return 'EndDate';
    }

    public function getFilterValues(): array
    {
        return [
            new DateFrom($this->dateFrom),
            new DateTo($this->dateTo),
        ];
    }
}
