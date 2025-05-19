<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetPaymentServices;

use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetPaymentServicesFilterInterface;

final readonly class Land implements GetPaymentServicesFilterInterface
{
    public function __construct(
        private CountryIsoEnum $countryIsoEnum
    ) {
    }

    public function getFilterName(): string
    {
        return 'Land';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->countryIsoEnum->value),
        ];
    }
}
