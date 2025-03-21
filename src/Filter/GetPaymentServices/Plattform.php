<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetPaymentServices;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetPaymentServicesFilterInterface;

final readonly class Plattform implements GetPaymentServicesFilterInterface
{
    public function __construct(
        private string $plattform
    ) {
    }

    public function getFilterName(): string
    {
        return 'Plattform';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->plattform),
        ];
    }
}
