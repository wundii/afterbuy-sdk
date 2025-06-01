<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetListerHistory;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ListedItems implements ResponseDtoInterface
{
    /**
     * @param ListedItem[] $listedItems
     */
    public function __construct(
        private int $resultCount = 0,
        private bool $hasMoreProducts = false,
        private array $listedItems = [],
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
