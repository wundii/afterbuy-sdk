<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShippingCost;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class ShippingInfo implements AfterbuyAppendXmlContentInterface
{
    /**
     * @param int|int[] $productIds
     */
    public function __construct(
        private int|array $productIds,
        private int $itemsCount,
        private float $itemsWeight,
        private float $itemsPrice,
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

    public function getItemsPrice(): float
    {
        return $this->itemsPrice;
    }

    public function getItemsWeight(): float
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
    #[Assert\Count(min: 1)]
    #[Assert\All(new Assert\Type('int'))]
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
