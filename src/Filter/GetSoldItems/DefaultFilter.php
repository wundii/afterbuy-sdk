<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetSoldItems;

use Wundii\AfterbuySdk\Enum\DefaultFilterSoldItemsEnum;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class DefaultFilter implements GetSoldItemsFilterInterface
{
    public function __construct(
        private DefaultFilterSoldItemsEnum $defaultFilterSoldItemsEnum
    ) {
    }

    public function getFilterName(): string
    {
        return 'DefaultFilter';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->defaultFilterSoldItemsEnum->value),
        ];
    }
}
