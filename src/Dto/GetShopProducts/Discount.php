<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShopProducts;

use AfterbuySdk\Interface\AfterbuyDtoInterface;
use DateTimeInterface;

final class Discount implements AfterbuyDtoInterface
{
    public function __construct(
        private int $shopId,
        private bool $discountActive,
        private int $controlId,
        private string $priceType,
        private string $newPriceType,
        private DateTimeInterface $startDate,
        private DateTimeInterface $expireDate,
        private int $type,
        private float $discountPercent,
        private float $savedAmount,
        private float $discountedPrice,
        private int $quantity,
    ) {
    }

    public function getControlId(): int
    {
        return $this->controlId;
    }

    public function setControlId(int $controlId): void
    {
        $this->controlId = $controlId;
    }

    public function isDiscountActive(): bool
    {
        return $this->discountActive;
    }

    public function setDiscountActive(bool $discountActive): void
    {
        $this->discountActive = $discountActive;
    }

    public function getDiscountedPrice(): float
    {
        return $this->discountedPrice;
    }

    public function setDiscountedPrice(float $discountedPrice): void
    {
        $this->discountedPrice = $discountedPrice;
    }

    public function getDiscountPercent(): float
    {
        return $this->discountPercent;
    }

    public function setDiscountPercent(float $discountPercent): void
    {
        $this->discountPercent = $discountPercent;
    }

    public function getExpireDate(): DateTimeInterface
    {
        return $this->expireDate;
    }

    public function setExpireDate(DateTimeInterface $expireDate): void
    {
        $this->expireDate = $expireDate;
    }

    public function getNewPriceType(): string
    {
        return $this->newPriceType;
    }

    public function setNewPriceType(string $newPriceType): void
    {
        $this->newPriceType = $newPriceType;
    }

    public function getPriceType(): string
    {
        return $this->priceType;
    }

    public function setPriceType(string $priceType): void
    {
        $this->priceType = $priceType;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getSavedAmount(): float
    {
        return $this->savedAmount;
    }

    public function setSavedAmount(float $savedAmount): void
    {
        $this->savedAmount = $savedAmount;
    }

    public function getShopId(): int
    {
        return $this->shopId;
    }

    public function setShopId(int $shopId): void
    {
        $this->shopId = $shopId;
    }

    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }
}
