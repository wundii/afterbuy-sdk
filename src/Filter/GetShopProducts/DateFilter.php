<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetShopProducts;

use DateTimeInterface;
use Wundii\AfterbuySdk\Enum\DateFilterEnum;
use Wundii\AfterbuySdk\Filter\DateFrom;
use Wundii\AfterbuySdk\Filter\DateTo;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetShopProductsFilterInterface;

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
