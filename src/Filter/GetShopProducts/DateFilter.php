<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShopProducts;

use AfterbuySdk\Enum\DateFilterEnum;
use AfterbuySdk\Filter\DateFrom;
use AfterbuySdk\Filter\DateTo;
use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;
use DateTimeInterface;

final readonly class DateFilter implements GetShopProductsFilterInterface
{
    public function __construct(
        private DateTimeInterface $dateFrom,
        private DateTimeInterface $dateTo,
        private DateFilterEnum $dateFilterEnum
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
            new FilterValue($this->dateFilterEnum->value),
        ];
    }
}
