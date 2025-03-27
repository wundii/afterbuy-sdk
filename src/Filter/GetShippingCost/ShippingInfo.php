<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetShippingCost;

use AfterbuySdk\Enum\CountryIsoEnum;

final readonly class ShippingInfo
{
    /**
     * @param int|int[] $productIds
     */
    public function __construct(
        private int|array $productIds,
        private int $itemsCount,
        private int $itemsWeight,
        private int $itemsPrice,
        private ?CountryIsoEnum $countryIsoEnum = null,
        private ?string $shippingGroup = null,
        private ?string $PostalCode = null,
    ) {
    }

    public function getItemsCount(): int
    {
        return $this->itemsCount;
    }

    public function getItemsPrice(): int
    {
        return $this->itemsPrice;
    }

    public function getItemsWeight(): int
    {
        return $this->itemsWeight;
    }

    public function getPostalCode(): ?string
    {
        return $this->PostalCode;
    }

    /**
     * @return int[]
     */
    public function getProductIds(): array
    {
        if (is_array($this->productIds)) {
            return $this->productIds;
        }

        return [$this->productIds];
    }

    public function getShippingCountry(): ?CountryIsoEnum
    {
        return $this->countryIsoEnum;
    }

    public function getShippingGroup(): ?string
    {
        return $this->shippingGroup;
    }
}
