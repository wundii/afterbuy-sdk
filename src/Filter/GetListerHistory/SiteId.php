<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetListerHistory;

use Wundii\AfterbuySdk\Enum\SiteIdEnum;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

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
