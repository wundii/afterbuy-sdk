<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetListerHistory;

use DateTimeInterface;
use Wundii\AfterbuySdk\Filter\DateFrom;
use Wundii\AfterbuySdk\Filter\DateTo;
use Wundii\AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class EndDate implements GetListerHistoryFilterInterface
{
    public function __construct(
        private DateTimeInterface $dateFrom,
        private DateTimeInterface $dateTo,
    ) {
    }

    public function getFilterName(): string
    {
        return 'EndDate';
    }

    public function getFilterValues(): array
    {
        return [
            new DateFrom($this->dateFrom->format('d.m.Y H:i:s')),
            new DateTo($this->dateTo->format('d.m.Y H:i:s')),
        ];
    }
}
