<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetListerHistory;

use AfterbuySdk\Filter\DateFrom;
use AfterbuySdk\Filter\DateTo;
use AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class StartDate implements GetListerHistoryFilterInterface
{
    public function __construct(
        private string $dateFrom,
        private string $dateTo ,
    ) {
    }

    public function getFilterName(): string
    {
        return 'StartDate';
    }

    public function getFilterValues(): array
    {
        return [
            new DateFrom($this->dateFrom),
            new DateTo($this->dateTo),
        ];
    }
}
