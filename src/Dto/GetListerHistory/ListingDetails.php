<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetListerHistory;

use DateTimeInterface;
use Wundii\AfterbuySdk\Enum\SellStatusEnum;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

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
        private ?int $ebayCategoryId = null,
        private ?int $ebayCategory2Id = null,
        private ?int $ebaySubAccountId = null,
        private ?float $ebayStartprice = null,
        private ?float $ebayBuyItNowPrice = null,
        private ?string $ebayPictureUrl = null,
        private ?string $ebayGaleryUrl = null,
        private ?bool $ebayRelist = null,
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

    public function getEbayBuyItNowPrice(): ?float
    {
        return $this->ebayBuyItNowPrice;
    }

    public function setEbayBuyItNowPrice(?float $ebayBuyItNowPrice): void
    {
        $this->ebayBuyItNowPrice = $ebayBuyItNowPrice;
    }

    public function getEbayCategory2Id(): ?int
    {
        return $this->ebayCategory2Id;
    }

    public function setEbayCategory2Id(?int $ebayCategory2Id): void
    {
        $this->ebayCategory2Id = $ebayCategory2Id;
    }

    public function getEbayCategoryId(): ?int
    {
        return $this->ebayCategoryId;
    }

    public function setEbayCategoryId(?int $ebayCategoryId): void
    {
        $this->ebayCategoryId = $ebayCategoryId;
    }

    public function getEbayGaleryUrl(): ?string
    {
        return $this->ebayGaleryUrl;
    }

    public function setEbayGaleryUrl(?string $ebayGaleryUrl): void
    {
        $this->ebayGaleryUrl = $ebayGaleryUrl;
    }

    public function getEbayPictureUrl(): ?string
    {
        return $this->ebayPictureUrl;
    }

    public function setEbayPictureUrl(?string $ebayPictureUrl): void
    {
        $this->ebayPictureUrl = $ebayPictureUrl;
    }

    public function getEbayRelist(): ?bool
    {
        return $this->ebayRelist;
    }

    public function setEbayRelist(?bool $ebayRelist): void
    {
        $this->ebayRelist = $ebayRelist;
    }

    public function getEbayStartprice(): ?float
    {
        return $this->ebayStartprice;
    }

    public function setEbayStartprice(?float $ebayStartprice): void
    {
        $this->ebayStartprice = $ebayStartprice;
    }

    public function getEbaySubAccountId(): ?int
    {
        return $this->ebaySubAccountId;
    }

    public function setEbaySubAccountId(?int $ebaySubAccountId): void
    {
        $this->ebaySubAccountId = $ebaySubAccountId;
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

    public function getSellStatus(): SellStatusEnum
    {
        return $this->sellStatusEnum;
    }

    public function setSellStatus(SellStatusEnum $sellStatusEnum): void
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
