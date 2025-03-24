<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetPaymentServices;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetPaymentServicesFilterInterface;

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
