<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetPaymentServices;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetPaymentServicesFilterInterface;

final readonly class ValueOfGoods implements GetPaymentServicesFilterInterface
{
    public function __construct(
        private string $valueOfGoods
    ) {
    }

    public function getFilterName(): string
    {
        return 'ValueOfGoods';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->valueOfGoods),
        ];
    }
}
