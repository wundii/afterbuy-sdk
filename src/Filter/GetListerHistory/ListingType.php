<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetListerHistory;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetListerHistoryFilterInterface;

final readonly class ListingType implements GetListerHistoryFilterInterface
{
    /**
     * Labelling of the respective platform
     * Possible values:
     * If PlattformName - eBay: 1 - Auktion, 2 - PowerAuktion, 7 - eBayStore, 9 - SofortKauf
     * If PlattformName - Azubo: 1 - Auktion, 9 - FixKauf
     * If PlattformName - elimbo: 0 - Festpreis
     */
    public function __construct(
        private int $listingType
    ) {
    }

    public function getFilterName(): string
    {
        return 'ListingType';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->listingType),
        ];
    }
}
