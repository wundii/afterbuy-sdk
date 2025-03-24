<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetListerHistory;

use AfterbuySdk\Filter\DateFrom;
use AfterbuySdk\Filter\DateTo;
use AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;
use DateTimeInterface;

final readonly class StartDate implements GetListerHistoryFilterInterface
{
    public function __construct(
        private DateTimeInterface $dateFrom,
        private DateTimeInterface $dateTo,
    ) {
    }

    public function getFilterName(): string
    {
        return 'StartDate';
    }

    public function getFilterValues(): array
    {
        return [
            new DateFrom($this->dateFrom->format('d.m.Y H:i:s')),
            new DateTo($this->dateTo->format('d.m.Y H:i:s')),
        ];
    }
}
