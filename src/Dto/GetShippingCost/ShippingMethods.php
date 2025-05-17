<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShippingCost;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ShippingMethods implements AfterbuyDtoInterface
{
    public function __construct(
        private float $shippingCost,
        private string $shippingMethod,
        private int $shippingMethodId,
        private ?float $shippingTaxRate = null,
        private ?string $shippingMethodDescription = null,
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

    public function getShippingMethodDescription(): ?string
    {
        return $this->shippingMethodDescription;
    }

    public function setShippingMethodDescription(?string $shippingMethodDescription): void
    {
        $this->shippingMethodDescription = $shippingMethodDescription;
    }

    public function getShippingTaxRate(): ?float
    {
        return $this->shippingTaxRate;
    }

    public function setShippingTaxRate(?float $shippingTaxRate): void
    {
        $this->shippingTaxRate = $shippingTaxRate;
    }
}
