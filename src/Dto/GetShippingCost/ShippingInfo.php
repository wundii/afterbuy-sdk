<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShippingCost;

use AfterbuySdk\Enum\CountryIsoEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class ShippingInfo implements AfterbuyAppendXmlContentInterface
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

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $shippingInfo = $xml->addChild('ShippingInfo');

        if (is_array($this->productIds) && count($this->productIds) > 1) {
            $productIdsElement = $shippingInfo->addChild('Products');
            foreach ($this->productIds as $productId) {
                $productIdsElement->addNumber('ProductID', $productId);
            }
        } else {
            $productId = $this->productIds[0] ?? (int) $this->productIds;
            $shippingInfo->addNumber('ProductID', $productId);
        }

        $shippingInfo->addNumber('ItemsCount', $this->itemsCount);
        $shippingInfo->addNumber('ItemsWeight', $this->itemsWeight);
        $shippingInfo->addNumber('ItemsPrice', $this->itemsPrice);
        $shippingInfo->addString('ShippingCountry', $this->countryIsoEnum?->value);
        $shippingInfo->addString('PostalCode', $this->PostalCode);
        $shippingInfo->addString('ShippingGroup', $this->shippingGroup);
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
