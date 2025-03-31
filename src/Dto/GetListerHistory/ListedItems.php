<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetListerHistory;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ListedItems implements AfterbuyDtoInterface
{
    /**
     * @param ListedItem[] $listedItems
     */
    public function __construct(
        private int $resultCount,
        private int $hasMoreProducts,
        private array $listedItems = [],
        private ?int $lastHistoryId = null,
    ) {
    }

    public function getHasMoreProducts(): int
    {
        return $this->hasMoreProducts;
    }

    public function setHasMoreProducts(int $hasMoreProducts): void
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
