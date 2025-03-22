<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetListerHistory;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class AccountId implements GetListerHistoryFilterInterface
{
    /**
     * Internal id of the SubAccount at Afterbuy.
     * If the value is set to 0, only the articles of the main account are returned.
     * If this filter is omitted, Main and SubAccount articles are returned.
     */
    public function __construct(
        private int $accountId
    ) {
    }

    public function getFilterName(): string
    {
        return 'AccountID';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->accountId),
        ];
    }
}
