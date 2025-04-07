<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ShopProductDetails implements AfterbuyDtoInterface
{
    public function __construct(
        private ?int $productId = null,
        private ?int $anr = null,
        private ?string $ean = null,
        private ?string $unitOfQuantity = null,
        private ?float $basepriceFactor = null,
        private ?BaseProductData $baseProductData = null,
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

    public function getBasepriceFactor(): ?float
    {
        return $this->basepriceFactor;
    }

    public function setBasepriceFactor(?float $basepriceFactor): void
    {
        $this->basepriceFactor = $basepriceFactor;
    }

    public function getBaseProductData(): ?BaseProductData
    {
        return $this->baseProductData;
    }

    public function setBaseProductData(?BaseProductData $baseProductData): void
    {
        $this->baseProductData = $baseProductData;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): void
    {
        $this->ean = $ean;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
    }

    public function getUnitOfQuantity(): ?string
    {
        return $this->unitOfQuantity;
    }

    public function setUnitOfQuantity(?string $unitOfQuantity): void
    {
        $this->unitOfQuantity = $unitOfQuantity;
    }
}
