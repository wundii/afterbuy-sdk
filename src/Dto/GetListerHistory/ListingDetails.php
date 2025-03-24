<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetListerHistory;

use AfterbuySdk\Enum\SellStatusEnum;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use DateTimeInterface;

final class ListingDetails implements AfterbuyDtoInterface
{
    public function __construct(
        private float $anr,
        private int $soldItems,
        private int $listedQuantity,
        private string $listingPlattform,
        private string $listingTitle,
        private SellStatusEnum $sellStatusEnum,
        private float $listingFee,
        private DateTimeInterface $startTime,
        private DateTimeInterface $endTime,
        private int $listingDuration,
        private int $listingType,
        private string $listingDescription,
        private ?int $eBayCategoryId = null,
        private ?int $eBayCategory2Id = null,
        private ?int $eBaySubAccountId = null,
        private ?float $eBayStartprice = null,
        private ?float $eBayBuyItNowPrice = null,
        private ?string $eBayPictureUrl = null,
        private ?string $eBayGaleryUrl = null,
        private ?bool $eBayRelist = null,
    ) {
    }

    public function getAnr(): float
    {
        return $this->anr;
    }

    public function setAnr(float $anr): void
    {
        $this->anr = $anr;
    }

    public function getEBayBuyItNowPrice(): ?float
    {
        return $this->eBayBuyItNowPrice;
    }

    public function setEBayBuyItNowPrice(?float $eBayBuyItNowPrice): void
    {
        $this->eBayBuyItNowPrice = $eBayBuyItNowPrice;
    }

    public function getEBayCategory2Id(): ?int
    {
        return $this->eBayCategory2Id;
    }

    public function setEBayCategory2Id(?int $eBayCategory2Id): void
    {
        $this->eBayCategory2Id = $eBayCategory2Id;
    }

    public function getEBayCategoryId(): ?int
    {
        return $this->eBayCategoryId;
    }

    public function setEBayCategoryId(?int $eBayCategoryId): void
    {
        $this->eBayCategoryId = $eBayCategoryId;
    }

    public function getEBayGaleryUrl(): ?string
    {
        return $this->eBayGaleryUrl;
    }

    public function setEBayGaleryUrl(?string $eBayGaleryUrl): void
    {
        $this->eBayGaleryUrl = $eBayGaleryUrl;
    }

    public function getEBayPictureUrl(): ?string
    {
        return $this->eBayPictureUrl;
    }

    public function setEBayPictureUrl(?string $eBayPictureUrl): void
    {
        $this->eBayPictureUrl = $eBayPictureUrl;
    }

    public function getEBayRelist(): ?bool
    {
        return $this->eBayRelist;
    }

    public function setEBayRelist(?bool $eBayRelist): void
    {
        $this->eBayRelist = $eBayRelist;
    }

    public function getEBayStartprice(): ?float
    {
        return $this->eBayStartprice;
    }

    public function setEBayStartprice(?float $eBayStartprice): void
    {
        $this->eBayStartprice = $eBayStartprice;
    }

    public function getEBaySubAccountId(): ?int
    {
        return $this->eBaySubAccountId;
    }

    public function setEBaySubAccountId(?int $eBaySubAccountId): void
    {
        $this->eBaySubAccountId = $eBaySubAccountId;
    }

    public function getEndTime(): DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(DateTimeInterface $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function getListedQuantity(): int
    {
        return $this->listedQuantity;
    }

    public function setListedQuantity(int $listedQuantity): void
    {
        $this->listedQuantity = $listedQuantity;
    }

    /**
     * Description of the item. If the ListerArticle has already been deleted, the 'ListingDescription' will be displayed as empty.
     */
    public function getListingDescription(): string
    {
        return $this->listingDescription;
    }

    public function setListingDescription(string $listingDescription): void
    {
        $this->listingDescription = $listingDescription;
    }

    public function getListingDuration(): int
    {
        return $this->listingDuration;
    }

    public function setListingDuration(int $listingDuration): void
    {
        $this->listingDuration = $listingDuration;
    }

    public function getListingFee(): float
    {
        return $this->listingFee;
    }

    public function setListingFee(float $listingFee): void
    {
        $this->listingFee = $listingFee;
    }

    public function getListingPlattform(): string
    {
        return $this->listingPlattform;
    }

    public function setListingPlattform(string $listingPlattform): void
    {
        $this->listingPlattform = $listingPlattform;
    }

    /**
     * Item title. If ListerArticle has already been deleted, the 'ListingTitle' will be displayed as empty.
     */
    public function getListingTitle(): string
    {
        return $this->listingTitle;
    }

    public function setListingTitle(string $listingTitle): void
    {
        $this->listingTitle = $listingTitle;
    }

    /**
     * Auction type
     * Possible values:
     * eBay: 1 - Auktion, 2 - PowerAuktion, 7 - eBayStore, 9 - SofortKauf
     * Azubo: 1 - Auktion, 9 - FixKauf
     * elimbo: 0 - Festpreis
     * Escout24: 0 - Keine Angabe
     */
    public function getListingType(): int
    {
        return $this->listingType;
    }

    public function setListingType(int $listingType): void
    {
        $this->listingType = $listingType;
    }

    public function getSellStatusEnum(): SellStatusEnum
    {
        return $this->sellStatusEnum;
    }

    public function setSellStatusEnum(SellStatusEnum $sellStatusEnum): void
    {
        $this->sellStatusEnum = $sellStatusEnum;
    }

    public function getSoldItems(): int
    {
        return $this->soldItems;
    }

    public function setSoldItems(int $soldItems): void
    {
        $this->soldItems = $soldItems;
    }

    public function getStartTime(): DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(DateTimeInterface $startTime): void
    {
        $this->startTime = $startTime;
    }
}
