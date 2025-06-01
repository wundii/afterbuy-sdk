<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ScaledDiscount implements ResponseDtoInterface
{
    public function __construct(
        private ?int $scaledQuantity = null,
        private ?float $scaledPrice = null,
        private ?float $scaledDPrice = null,
    ) {
    }

    public function getScaledDPrice(): ?float
    {
        return $this->scaledDPrice;
    }

    public function setScaledDPrice(?float $scaledDPrice): void
    {
        $this->scaledDPrice = $scaledDPrice;
    }

    public function getScaledPrice(): ?float
    {
        return $this->scaledPrice;
    }

    public function setScaledPrice(?float $scaledPrice): void
    {
        $this->scaledPrice = $scaledPrice;
    }

    public function getScaledQuantity(): ?int
    {
        return $this->scaledQuantity;
    }

    public function setScaledQuantity(?int $scaledQuantity): void
    {
        $this->scaledQuantity = $scaledQuantity;
    }
}
