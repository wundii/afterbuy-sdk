<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetListerHistory;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\Structron\Attribute\Description;

final class ListedItem implements ResponseDtoInterface
{
    public function __construct(
        #[Description('Internal Afterbuy ID of the history entry')]
        private int $historyId,
        #[Description('Item number. This article number is assigned after creating a listing on the respective platform')]
        private int $listingId,
        #[Description('Item number. This article number is assigned after creating a listing on the respective platform')]
        private int $productId,
        #[Description('')]
        private ?int $variationType = null,
        #[Description('Container with details concerning the listing')]
        private ?ListingDetails $listingDetails = null,
        #[Description('Container with product details for the listing')]
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

    public function getVariationType(): ?int
    {
        return $this->variationType;
    }

    public function setVariationType(?int $variationType): void
    {
        $this->variationType = $variationType;
    }
}
