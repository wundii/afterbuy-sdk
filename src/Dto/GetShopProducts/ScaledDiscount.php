<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShopProducts;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ScaledDiscount implements AfterbuyDtoInterface
{
    public function __construct(
        private int $scaledQuantity,
        private float $scaledPrice,
        private float $scaledDPrice,
    ) {
    }

    public function getScaledDPrice(): float
    {
        return $this->scaledDPrice;
    }

    public function setScaledDPrice(float $scaledDPrice): void
    {
        $this->scaledDPrice = $scaledDPrice;
    }

    public function getScaledPrice(): float
    {
        return $this->scaledPrice;
    }

    public function setScaledPrice(float $scaledPrice): void
    {
        $this->scaledPrice = $scaledPrice;
    }

    public function getScaledQuantity(): int
    {
        return $this->scaledQuantity;
    }

    public function setScaledQuantity(int $scaledQuantity): void
    {
        $this->scaledQuantity = $scaledQuantity;
    }
}
