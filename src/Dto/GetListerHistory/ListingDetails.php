<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetListerHistory;

use DateTimeInterface;
use Wundii\AfterbuySdk\Enum\EbayCurrencyEnum;
use Wundii\AfterbuySdk\Enum\ListingCountryEnum;
use Wundii\AfterbuySdk\Enum\SellStatusEnum;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\Structron\Attribute\Description;

final class ListingDetails implements ResponseDtoInterface
{
    public function __construct(
        #[Description('Item number. This article number is assigned after creating a listing on the respective platform')]
        private int $anr,
        #[Description('Number of items already sold for this listing')]
        private ?int $soldItems = null,
        #[Description('Listed quantity')]
        private ?int $listedQuantity = null,
        #[Description('Listing platform')]
        private ?string $listingPlattform = null,
        #[Description("Item title. If ListerArticle has already been deleted, the 'ListingTitle' will be displayed as empty")]
        private ?string $listingTitle = null,
        #[Description('')]
        private ?string $listerSubTitle = null,
        #[Description('Duration in days')]
        private ?int $listingDuration = null,
        #[Description('Auction type<br>
            Possible values:<br>
            eBay: 1 - Auktion, 2 - PowerAuktion, 7 - eBayStore, 9 - SofortKauf<br>
            Azubo: 1 - Auktion, 9 - FixKauf<br>
            elimbo: 0 - Festpreis<br>
            Escout24: 0 - Keine Angabe')]
        private ?int $listingType = null,
        #[Description("Description of the item. If the ListerArticle has already been deleted, the 'ListingDescription' will be displayed as empty")]
        private ?string $listingDescription = null,
        #[Description('Listing costs of the respective platform')]
        private ?float $listingFee = null,
        #[Description('')]
        private ?ListingCountryEnum $listingCountryEnum = null,
        #[Description('Selling status')]
        private ?SellStatusEnum $sellStatusEnum = null,
        #[Description('Start time of the article')]
        private ?DateTimeInterface $startTime = null,
        #[Description('End time of the article')]
        private ?DateTimeInterface $endTime = null,
        #[Description('')]
        private ?int $ebayCurrencyId = null,
        #[Description('')]
        private ?EbayCurrencyEnum $ebayCurrencyEnum = null,
        #[Description("eBay category. If ListerItem has already been deleted, the 'eBayCategoryID' will be displayed as empty")]
        private ?int $ebayCategoryId = null,
        #[Description("Second eBay category. If the ListerItem has already been deleted, the 'eBayCategory2ID' will be displayed as empty")]
        private ?int $ebayCategory2Id = null,
        #[Description('SubAccountID of the account that the listing was created with')]
        private ?int $ebaySubAccountId = null,
        #[Description("eBay starting price of the item. If ListerArticle has already been deleted, the 'eBayStartprice' will be displayed as empty")]
        private ?float $ebayStartprice = null,
        #[Description("eBay SofortKaufpreis of the item. If ListerArticle has already been deleted, the 'eBayBuyItNowPrice' will be displayed as empty")]
        private ?float $ebayBuyItNowPrice = null,
        #[Description("eBay SofortKaufpreis of the item. If ListerArticle has already been deleted, the 'eBayPictureURL' will not be returned")]
        private ?string $ebayPictureUrl = null,
        #[Description("eBay SofortKaufpreis of the item. If ListerArticle has already been deleted, the 'eBayGaleryURL' will not be returned")]
        private ?string $ebayGaleryUrl = null,
        #[Description('Indicates whether the item is an eBay relist')]
        private ?bool $ebayRelist = null,
    ) {
    }

    public function getAnr(): int
    {
        return $this->anr;
    }

    public function setAnr(int $anr): void
    {
        $this->anr = $anr;
    }

    /**
     * Description of the item. If the ListerArticle has already been deleted, the 'ListingDescription' will be displayed as empty.
     */
    public function getListingDescription(): ?string
    {
        return $this->listingDescription;
    }

    public function setListingDescription(?string $listingDescription): void
    {
        $this->listingDescription = $listingDescription;
    }

    /**
     * Item title. If ListerArticle has already been deleted, the 'ListingTitle' will be displayed as empty.
     */
    public function getListingTitle(): ?string
    {
        return $this->listingTitle;
    }

    public function setListingTitle(?string $listingTitle): void
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
    public function getListingType(): ?int
    {
        return $this->listingType;
    }

    public function setListingType(?int $listingType): void
    {
        $this->listingType = $listingType;
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

    public function getEbayCurrency(): ?EbayCurrencyEnum
    {
        return $this->ebayCurrencyEnum;
    }

    public function setEbayCurrency(?EbayCurrencyEnum $ebayCurrencyEnum): void
    {
        $this->ebayCurrencyEnum = $ebayCurrencyEnum;
    }

    public function getEbayCurrencyId(): ?int
    {
        return $this->ebayCurrencyId;
    }

    public function setEbayCurrencyId(?int $ebayCurrencyId): void
    {
        $this->ebayCurrencyId = $ebayCurrencyId;
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

    public function getEndTime(): ?DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(?DateTimeInterface $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function getListedQuantity(): ?int
    {
        return $this->listedQuantity;
    }

    public function setListedQuantity(?int $listedQuantity): void
    {
        $this->listedQuantity = $listedQuantity;
    }

    public function getListerSubTitle(): ?string
    {
        return $this->listerSubTitle;
    }

    public function setListerSubTitle(?string $listerSubTitle): void
    {
        $this->listerSubTitle = $listerSubTitle;
    }

    public function getListingCountry(): ?ListingCountryEnum
    {
        return $this->listingCountryEnum;
    }

    public function setListingCountry(?ListingCountryEnum $listingCountryEnum): void
    {
        $this->listingCountryEnum = $listingCountryEnum;
    }

    public function getListingDuration(): ?int
    {
        return $this->listingDuration;
    }

    public function setListingDuration(?int $listingDuration): void
    {
        $this->listingDuration = $listingDuration;
    }

    public function getListingFee(): ?float
    {
        return $this->listingFee;
    }

    public function setListingFee(?float $listingFee): void
    {
        $this->listingFee = $listingFee;
    }

    public function getListingPlattform(): ?string
    {
        return $this->listingPlattform;
    }

    public function setListingPlattform(?string $listingPlattform): void
    {
        $this->listingPlattform = $listingPlattform;
    }

    public function getSoldItems(): ?int
    {
        return $this->soldItems;
    }

    public function setSoldItems(?int $soldItems): void
    {
        $this->soldItems = $soldItems;
    }

    public function getStartTime(): ?DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(?DateTimeInterface $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getSellStatus(): ?SellStatusEnum
    {
        return $this->sellStatusEnum;
    }

    public function setSellStatus(?SellStatusEnum $sellStatusEnum): void
    {
        $this->sellStatusEnum = $sellStatusEnum;
    }
}
