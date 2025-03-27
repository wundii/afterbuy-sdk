<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetSoldItems;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class Tag implements GetSoldItemsFilterInterface
{
    public function __construct(
        private string $tag
    ) {
    }

    public function getFilterName(): string
    {
        return 'Tag';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->tag),
        ];
    }
}
