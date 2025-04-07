<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class SoldItems implements AfterbuyDtoInterface
{
    /**
     * @param SoldItem[] $soldItem
     */
    public function __construct(
        private int $itemsInOrder,
        private array $soldItem = [],
    ) {
    }

    public function getItemsInOrder(): int
    {
        return $this->itemsInOrder;
    }

    public function setItemsInOrder(int $itemsInOrder): void
    {
        $this->itemsInOrder = $itemsInOrder;
    }

    /**
     * @return SoldItem[]
     */
    public function getSoldItem(): array
    {
        return $this->soldItem;
    }

    public function setSoldItem(?SoldItem $soldItem): void
    {
        if (! $soldItem instanceof SoldItem) {
            return;
        }

        $this->soldItem[] = $soldItem;
    }
}
