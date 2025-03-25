<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetStockInfo;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class Product implements AfterbuyDtoInterface
{
    public function __construct(
        private int $productId,
        private ?string $name = null,
        private ?int $anr = null,
        private ?string $ean = null,
        private ?int $auctionQuantity = null,
        private ?int $quantity = null,
        private ?int $fullFilmentQuantity = null,
        private ?int $minimumStock = null,
        private bool $discontinued = false,
        private bool $mergeStock = false,
        private bool $availableShop = false,
        private bool $available = false,
        private ?int $realQuantity = null,
    ) {
    }

    public function getAnr(): ?int
    {
        return $this->anr;
    }

    public function setAnr(?int $anr): void
    {
        $this->anr = $anr;
    }

    public function getAuctionQuantity(): ?int
    {
        return $this->auctionQuantity;
    }

    public function setAuctionQuantity(?int $auctionQuantity): void
    {
        $this->auctionQuantity = $auctionQuantity;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }

    public function isAvailableShop(): bool
    {
        return $this->availableShop;
    }

    public function setAvailableShop(bool $availableShop): void
    {
        $this->availableShop = $availableShop;
    }

    public function isDiscontinued(): bool
    {
        return $this->discontinued;
    }

    public function setDiscontinued(bool $discontinued): void
    {
        $this->discontinued = $discontinued;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): void
    {
        $this->ean = $ean;
    }

    public function getFullFilmentQuantity(): ?int
    {
        return $this->fullFilmentQuantity;
    }

    public function setFullFilmentQuantity(?int $fullFilmentQuantity): void
    {
        $this->fullFilmentQuantity = $fullFilmentQuantity;
    }

    public function isMergeStock(): bool
    {
        return $this->mergeStock;
    }

    public function setMergeStock(bool $mergeStock): void
    {
        $this->mergeStock = $mergeStock;
    }

    public function getMinimumStock(): ?int
    {
        return $this->minimumStock;
    }

    public function setMinimumStock(?int $minimumStock): void
    {
        $this->minimumStock = $minimumStock;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getRealQuantity(): ?int
    {
        return $this->realQuantity;
    }

    public function setRealQuantity(?int $realQuantity): void
    {
        $this->realQuantity = $realQuantity;
    }
}
