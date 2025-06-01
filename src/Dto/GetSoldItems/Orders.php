<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class Orders implements ResponseDtoInterface
{
    /**
     * @param Order[] $orders
     */
    public function __construct(
        private bool $hasMoreItems = false,
        private array $orders = [],
        private int $ordersCount = 0,
        private ?int $lastOrderId = null,
        private int $itemsCount = 0,
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

    public function getItemsCount(): int
    {
        return $this->itemsCount;
    }

    public function setItemsCount(int $itemsCount): void
    {
        $this->itemsCount = $itemsCount;
    }

    public function getLastOrderId(): ?int
    {
        return $this->lastOrderId;
    }

    public function setLastOrderId(?int $lastOrderId): void
    {
        $this->lastOrderId = $lastOrderId;
    }

    public function getOrdersCount(): int
    {
        return $this->ordersCount;
    }

    public function setOrdersCount(int $ordersCount): void
    {
        $this->ordersCount = $ordersCount;
    }
}
