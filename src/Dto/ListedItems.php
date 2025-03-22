<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ListedItems implements AfterbuyDtoInterface
{
    /**
     * @param ListedItem[] $listedItems
     */
    public function __construct(
        private int $resultCount,
        private int $hasMoreProducts,
        private array $listedItems,
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
