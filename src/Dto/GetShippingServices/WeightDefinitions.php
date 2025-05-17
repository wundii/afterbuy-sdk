<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShippingServices;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class WeightDefinitions implements AfterbuyDtoInterface
{
    public function __construct(
        private float $weightFrom,
        private float $weightTo,
        private float $price,
    ) {
    }

    public function getWeightFrom(): float
    {
        return $this->weightFrom;
    }

    public function setWeightFrom(float $weightFrom): void
    {
        $this->weightFrom = $weightFrom;
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
