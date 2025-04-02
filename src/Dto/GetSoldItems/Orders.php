<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetSoldItems;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class Orders implements AfterbuyDtoInterface
{
    /**
     * @param Order[] $orders
     */
    public function __construct(
        private bool $hasMoreItems = false,
        private array $orders = [],
    ) {
    }

    public function hasMoreItems(): bool
    {
        return $this->hasMoreItems;
    }

    public function setHasMoreItems(bool $hasMoreItems): void
    {
        $this->hasMoreItems = $hasMoreItems;
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param Order[] $orders
     */
    public function setOrders(array $orders): void
    {
        $this->orders = $orders;
    }
}
