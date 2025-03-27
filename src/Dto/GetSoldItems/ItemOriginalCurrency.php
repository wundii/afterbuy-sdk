<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetSoldItems;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ItemOriginalCurrency implements AfterbuyDtoInterface
{
    public function __construct(
        private ?float $itemPrice = null,
        private ?string $itemPriceCode = null,
        private ?float $itemShipping = null,
    ) {
    }

    public function getItemPrice(): ?float
    {
        return $this->itemPrice;
    }

    public function setItemPrice(?float $itemPrice): void
    {
        $this->itemPrice = $itemPrice;
    }

    public function getItemPriceCode(): ?string
    {
        return $this->itemPriceCode;
    }

    public function setItemPriceCode(?string $itemPriceCode): void
    {
        $this->itemPriceCode = $itemPriceCode;
    }

    public function getItemShipping(): ?float
    {
        return $this->itemShipping;
    }

    public function setItemShipping(?float $itemShipping): void
    {
        $this->itemShipping = $itemShipping;
    }
}
