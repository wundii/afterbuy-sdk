<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetListerHistory;

use AfterbuySdk\Enum\SiteIdEnum;
use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class SiteId implements GetListerHistoryFilterInterface
{
    public function __construct(
        private SiteIdEnum $siteIdEnum
    ) {
    }

    public function getFilterName(): string
    {
        return 'Plattform';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->siteIdEnum->value),
        ];
    }
}
