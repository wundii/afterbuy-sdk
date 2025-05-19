<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetSoldItems;

use DateTimeInterface;
use Wundii\AfterbuySdk\Enum\DateFilterSoldItemsEnum;
use Wundii\AfterbuySdk\Filter\DateFrom;
use Wundii\AfterbuySdk\Filter\DateTo;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

final readonly class DateFilter implements GetShopProductsFilterInterface
{
    public function __construct(
        private DateTimeInterface $dateFrom,
        private DateTimeInterface $dateTo,
        private DateFilterSoldItemsEnum $dateFilterSoldItemsEnum
    ) {
    }

    public function getFilterName(): string
    {
        return 'DateFilter';
    }

    public function getFilterValues(): array
    {
        return [
            new DateFrom($this->dateFrom->format('d.m.Y H:i:s')),
            new DateTo($this->dateTo->format('d.m.Y H:i:s')),
            new FilterValue($this->dateFilterSoldItemsEnum->value),
        ];
    }
}
