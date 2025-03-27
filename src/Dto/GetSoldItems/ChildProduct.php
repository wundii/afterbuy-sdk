<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetSoldItems;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ChildProduct implements AfterbuyDtoInterface
{
    public function __construct(
        private ?int $productId = null,
        private ?int $productAnr = null,
        private ?string $productEan = null,
        private ?string $productName = null,
        private int $productQuantity = 0,
        private float $productVat = 0,
        private float $productWeight = 0,
        private float $productUnitPrice = 0,
        private ?string $stockLocation1 = null,
        private ?string $stockLocation2 = null,
        private ?string $stockLocation3 = null,
    ) {
    }

    public function getProductAnr(): ?int
    {
        return $this->productAnr;
    }

    public function setProductAnr(?int $productAnr): void
    {
        $this->productAnr = $productAnr;
    }

    public function getProductEan(): ?string
    {
        return $this->productEan;
    }

    public function setProductEan(?string $productEan): void
    {
        $this->productEan = $productEan;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(?string $productName): void
    {
        $this->productName = $productName;
    }

    public function getProductQuantity(): int
    {
        return $this->productQuantity;
    }

    public function setProductQuantity(int $productQuantity): void
    {
        $this->productQuantity = $productQuantity;
    }

    public function getProductUnitPrice(): float
    {
        return $this->productUnitPrice;
    }

    public function setProductUnitPrice(float $productUnitPrice): void
    {
        $this->productUnitPrice = $productUnitPrice;
    }

    public function getProductVat(): float
    {
        return $this->productVat;
    }

    public function setProductVat(float $productVat): void
    {
        $this->productVat = $productVat;
    }

    public function getProductWeight(): float
    {
        return $this->productWeight;
    }

    public function setProductWeight(float $productWeight): void
    {
        $this->productWeight = $productWeight;
    }

    public function getStockLocation1(): ?string
    {
        return $this->stockLocation1;
    }

    public function setStockLocation1(?string $stockLocation1): void
    {
        $this->stockLocation1 = $stockLocation1;
    }

    public function getStockLocation2(): ?string
    {
        return $this->stockLocation2;
    }

    public function setStockLocation2(?string $stockLocation2): void
    {
        $this->stockLocation2 = $stockLocation2;
    }

    public function getStockLocation3(): ?string
    {
        return $this->stockLocation3;
    }

    public function setStockLocation3(?string $stockLocation3): void
    {
        $this->stockLocation3 = $stockLocation3;
    }
}
