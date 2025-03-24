<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShopProducts;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class BaseProductsRelationData implements AfterbuyDtoInterface
{
    public function __construct(
        private int $quantity,
        private string $variationLabel,
        private string $defaultProduct,
        private int $position,
        private ?EbayVariationData $eBayVariationData = null,
    ) {
    }

    public function getDefaultProduct(): string
    {
        return $this->defaultProduct;
    }

    public function setDefaultProduct(string $defaultProduct): void
    {
        $this->defaultProduct = $defaultProduct;
    }

    public function getEBayVariationData(): ?EbayVariationData
    {
        return $this->eBayVariationData;
    }

    public function setEBayVariationData(?EbayVariationData $eBayVariationData): void
    {
        $this->eBayVariationData = $eBayVariationData;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getVariationLabel(): string
    {
        return $this->variationLabel;
    }

    public function setVariationLabel(string $variationLabel): void
    {
        $this->variationLabel = $variationLabel;
    }
}
