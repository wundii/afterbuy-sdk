<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ListedItem implements AfterbuyDtoInterface
{
    public function __construct(
        private int $historyId,
        private int $listingId,
        private int $productId,
        private ?ListingDetails $listingDetails = null,
        private ?ProductDetails $productDetails = null,
    ) {
    }

    public function getHistoryId(): int
    {
        return $this->historyId;
    }

    public function setHistoryId(int $historyId): void
    {
        $this->historyId = $historyId;
    }

    public function getListingDetails(): ?ListingDetails
    {
        return $this->listingDetails;
    }

    public function setListingDetails(?ListingDetails $listingDetails): void
    {
        $this->listingDetails = $listingDetails;
    }

    public function getListingId(): int
    {
        return $this->listingId;
    }

    public function setListingId(int $listingId): void
    {
        $this->listingId = $listingId;
    }

    public function getProductDetails(): ?ProductDetails
    {
        return $this->productDetails;
    }

    public function setProductDetails(?ProductDetails $productDetails): void
    {
        $this->productDetails = $productDetails;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }
}
