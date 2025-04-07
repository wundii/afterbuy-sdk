<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class NewProduct implements AfterbuyDtoInterface
{
    public function __construct(
        private ?int $productId = null,
        private ?int $productIdRequested = null,
        private ?string $userProductId = null,
        private ?int $anrRequested = null,
        private ?string $eanRequested = null,
        private ?int $anr = null,
        private ?string $ean = null,
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

    public function getAnrRequested(): ?int
    {
        return $this->anrRequested;
    }

    public function setAnrRequested(?int $anrRequested): void
    {
        $this->anrRequested = $anrRequested;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): void
    {
        $this->ean = $ean;
    }

    public function getEanRequested(): ?string
    {
        return $this->eanRequested;
    }

    public function setEanRequested(?string $eanRequested): void
    {
        $this->eanRequested = $eanRequested;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
    }

    public function getProductIdRequested(): ?int
    {
        return $this->productIdRequested;
    }

    public function setProductIdRequested(?int $productIdRequested): void
    {
        $this->productIdRequested = $productIdRequested;
    }

    public function getUserProductId(): ?string
    {
        return $this->userProductId;
    }

    public function setUserProductId(?string $userProductId): void
    {
        $this->userProductId = $userProductId;
    }
}
