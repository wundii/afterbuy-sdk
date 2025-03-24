<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShippingServices;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class WeightDefinitions implements AfterbuyDtoInterface
{
    public function __construct(
        private float $weightTo,
        private float $price,
    ) {
    }

    public function getWeightTo(): float
    {
        return $this->weightTo;
    }

    public function setWeightTo(float $weightTo): void
    {
        $this->weightTo = $weightTo;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
