<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetPaymentServices;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetPaymentServicesFilterInterface;

final readonly class Land implements GetPaymentServicesFilterInterface
{
    public function __construct(
        private string $land
    ) {
    }

    public function getFilterName(): string
    {
        return 'Land';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->land),
        ];
    }
}
