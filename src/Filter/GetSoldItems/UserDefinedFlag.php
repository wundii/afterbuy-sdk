<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetSoldItems;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;

final readonly class UserDefinedFlag implements GetSoldItemsFilterInterface
{
    public function __construct(
        private int $userDefinedFlag
    ) {
    }

    public function getFilterName(): string
    {
        return 'UserDefinedFlag';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->userDefinedFlag),
        ];
    }
}
