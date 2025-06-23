<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetListerHistory;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Description;
use Wundii\Structron\Attribute\Structron;

#[Structron('Hold a list of items that were listed in the Lister history.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class ListedItems implements ResponseDtoInterface
{
    /**
     * @param ListedItem[] $listedItems
     */
    public function __construct(
        #[Description('The total number of results')]
        private int $resultCount = 0,
        #[Description('Indicates whether there are any other results')]
        private bool $hasMoreProducts = false,
        #[Description('A list of items that were listed in the Lister history')]
        private array $listedItems = [],
        #[Description('The ID of the last history entry, used for pagination')]
        private ?int $lastHistoryId = null,
    ) {
    }

    public function hasMoreProducts(): bool
    {
        return $this->hasMoreProducts;
    }

    public function setHasMoreProducts(bool $hasMoreProducts): void
    {
        $this->hasMoreProducts = $hasMoreProducts;
    }

    public function getLastHistoryId(): ?int
    {
        return $this->lastHistoryId;
    }

    public function setLastHistoryId(?int $lastHistoryId): void
    {
        $this->lastHistoryId = $lastHistoryId;
    }

    /**
     * @return ListedItem[]
     */
    public function getListedItems(): array
    {
        return $this->listedItems;
    }

    /**
     * @param ListedItem[] $listedItems
     */
    public function setListedItems(array $listedItems): void
    {
        $this->listedItems = $listedItems;
    }

    public function getResultCount(): int
    {
        return $this->resultCount;
    }

    public function setResultCount(int $resultCount): void
    {
        $this->resultCount = $resultCount;
    }
}
