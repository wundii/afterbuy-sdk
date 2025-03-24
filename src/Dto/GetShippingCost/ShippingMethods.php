<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShippingCost;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ShippingMethods implements AfterbuyDtoInterface
{
    public function __construct(
        private float $shippingCost,
        private string $shippingMethod,
        private int $shippingMethodId,
    ) {
    }

    public function getShippingCost(): float
    {
        return $this->shippingCost;
    }

    public function setShippingCost(float $shippingCost): void
    {
        $this->shippingCost = $shippingCost;
    }

    public function getShippingMethod(): string
    {
        return $this->shippingMethod;
    }

    public function setShippingMethod(string $shippingMethod): void
    {
        $this->shippingMethod = $shippingMethod;
    }

    public function getShippingMethodId(): int
    {
        return $this->shippingMethodId;
    }

    public function setShippingMethodId(int $shippingMethodId): void
    {
        $this->shippingMethodId = $shippingMethodId;
    }
}
