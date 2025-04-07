<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetPaymentServices;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetPaymentServicesFilterInterface;

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
