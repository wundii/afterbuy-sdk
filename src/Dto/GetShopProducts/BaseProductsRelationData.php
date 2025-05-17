<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class BaseProductsRelationData implements AfterbuyDtoInterface
{
    public function __construct(
        private int $quantity,
        private string $variationLabel,
        private string $defaultProduct,
        private int $position,
        private ?EbayVariationData $ebayVariationData = null,
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

    public function getEbayVariationData(): ?EbayVariationData
    {
        return $this->ebayVariationData;
    }

    public function setEbayVariationData(?EbayVariationData $ebayVariationData): void
    {
        $this->ebayVariationData = $ebayVariationData;
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
