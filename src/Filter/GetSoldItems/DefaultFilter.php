<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetSoldItems;

use AfterbuySdk\Enum\DefaultFilterSoldItemsEnum;
use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

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
