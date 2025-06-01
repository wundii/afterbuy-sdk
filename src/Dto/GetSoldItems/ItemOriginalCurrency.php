<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use Wundii\AfterbuySdk\Enum\ItemPriceCodeEnum;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ItemOriginalCurrency implements ResponseDtoInterface
{
    public function __construct(
        private ?float $itemPrice = null,
        private ?ItemPriceCodeEnum $itemPriceCodeEnum = null,
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

    public function getItemPriceCode(): ?ItemPriceCodeEnum
    {
        return $this->itemPriceCodeEnum;
    }

    public function setItemPriceCode(?ItemPriceCodeEnum $itemPriceCodeEnum): void
    {
        $this->itemPriceCodeEnum = $itemPriceCodeEnum;
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
