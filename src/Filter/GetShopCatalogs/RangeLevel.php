<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetShopCatalogs;

use Wundii\AfterbuySdk\Filter\ValueFrom;
use Wundii\AfterbuySdk\Filter\ValueTo;
use Wundii\AfterbuySdk\Interface\Filter\GetShopCatalogsFilterInterface;

final readonly class RangeLevel implements GetShopCatalogsFilterInterface
{
    public function __construct(
        private int $levelFrom,
        private int $levelTo,
    ) {
    }

    public function getFilterName(): string
    {
        return 'RangeLevel';
    }

    public function getFilterValues(): array
    {
        return [
            new ValueFrom((string) $this->levelFrom),
            new ValueTo((string) $this->levelTo),
        ];
    }
}
