<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetSoldItems;

use AfterbuySdk\Enum\FulfillmentServiceLevelEnum;
use AfterbuySdk\Enum\InternalItemTypeEnum;
use AfterbuySdk\Enum\ItemPlatFormNameEnum;
use AfterbuySdk\Enum\TaxCollectedByEnum;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use DateTimeInterface;

final class SoldItem implements AfterbuyDtoInterface
{
    public function __construct(
        private int $itemId,
        private bool $itemDetailsDone = false,
        private ?int $anr = null,
        private bool $isAmazonBusiness = false,
        private bool $isAmazonPrime = false,
        private FulfillmentServiceLevelEnum $fulfillmentServiceLevelEnum = FulfillmentServiceLevelEnum::NONE,
        private ?string $platformSpecificOrderId = null,
        private ?int $eBayTransactionId = null,
        private ?string $alternativeItemNumber1 = null,
        private ?string $alternativeItemNumbe1 = null,
        private ?InternalItemTypeEnum $internalItemTypeEnum = null,
        private ?int $userDefinedFlag = null,
        private ?string $itemTitle = null,
        private ?int $itemQuantity = null,
        private ?float $itemPrice = null,
        private ?DateTimeInterface $itemEndDate = null,
        private ?float $taxRate = null,
        private ?TaxCollectedByEnum $taxCollectedByEnum = null,
        private ?string $platformTaxReference = null,
        private ?float $itemWeight = null,
        private ?DateTimeInterface $itemXmlDate = null,
        private ?DateTimeInterface $itemModDate = null,
        private ?ItemPlatFormNameEnum $itemPlatFormNameEnum = null,
        private ?string $itemLink = null,
        private ?bool $eBayFeedbackCompleted = null,
        private ?bool $eBayFeedbackReceived = null,
        private ?string $eBayFeedbackType = null,
        private ?ItemOriginalCurrency $itemOriginalCurrency = null,
        private ?ShopProductDetails $shopProductDetails = null,
    ) {
    }

    public function getAlternativeItemNumbe1(): ?string
    {
        return $this->alternativeItemNumbe1;
    }

    public function setAlternativeItemNumbe1(?string $alternativeItemNumbe1): void
    {
        $this->alternativeItemNumbe1 = $alternativeItemNumbe1;
    }

    public function getAlternativeItemNumber1(): ?string
    {
        return $this->alternativeItemNumber1;
    }

    public function setAlternativeItemNumber1(?string $alternativeItemNumber1): void
    {
        $this->alternativeItemNumber1 = $alternativeItemNumber1;
    }

    public function getAnr(): ?int
    {
        return $this->anr;
    }

    public function setAnr(?int $anr): void
    {
        $this->anr = $anr;
    }

    public function getEBayTransactionId(): ?int
    {
        return $this->eBayTransactionId;
    }

    public function setEBayTransactionId(?int $eBayTransactionId): void
    {
        $this->eBayTransactionId = $eBayTransactionId;
    }

    public function getFulfillmentServiceLevelEnum(): FulfillmentServiceLevelEnum
    {
        return $this->fulfillmentServiceLevelEnum;
    }

    public function setFulfillmentServiceLevelEnum(FulfillmentServiceLevelEnum $fulfillmentServiceLevelEnum): void
    {
        $this->fulfillmentServiceLevelEnum = $fulfillmentServiceLevelEnum;
    }

    public function isAmazonBusiness(): bool
    {
        return $this->isAmazonBusiness;
    }

    public function setIsAmazonBusiness(bool $isAmazonBusiness): void
    {
        $this->isAmazonBusiness = $isAmazonBusiness;
    }

    public function isAmazonPrime(): bool
    {
        return $this->isAmazonPrime;
    }

    public function setIsAmazonPrime(bool $isAmazonPrime): void
    {
        $this->isAmazonPrime = $isAmazonPrime;
    }

    public function isItemDetailsDone(): bool
    {
        return $this->itemDetailsDone;
    }

    public function setItemDetailsDone(bool $itemDetailsDone): void
    {
        $this->itemDetailsDone = $itemDetailsDone;
    }

    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function setItemId(int $itemId): void
    {
        $this->itemId = $itemId;
    }

    public function getPlatformSpecificOrderId(): ?string
    {
        return $this->platformSpecificOrderId;
    }

    public function setPlatformSpecificOrderId(?string $platformSpecificOrderId): void
    {
        $this->platformSpecificOrderId = $platformSpecificOrderId;
    }

    public function getInternalItemType(): ?InternalItemTypeEnum
    {
        return $this->internalItemTypeEnum;
    }

    public function setInternalItemType(?InternalItemTypeEnum $internalItemTypeEnum): void
    {
        $this->internalItemTypeEnum = $internalItemTypeEnum;
    }

    public function getItemEndDate(): ?DateTimeInterface
    {
        return $this->itemEndDate;
    }

    public function setItemEndDate(?DateTimeInterface $itemEndDate): void
    {
        $this->itemEndDate = $itemEndDate;
    }

    public function getItemModDate(): ?DateTimeInterface
    {
        return $this->itemModDate;
    }

    public function setItemModDate(?DateTimeInterface $itemModDate): void
    {
        $this->itemModDate = $itemModDate;
    }

    public function getItemPrice(): ?float
    {
        return $this->itemPrice;
    }

    public function setItemPrice(?float $itemPrice): void
    {
        $this->itemPrice = $itemPrice;
    }

    public function getItemQuantity(): ?int
    {
        return $this->itemQuantity;
    }

    public function setItemQuantity(?int $itemQuantity): void
    {
        $this->itemQuantity = $itemQuantity;
    }

    public function getItemTitle(): ?string
    {
        return $this->itemTitle;
    }

    public function setItemTitle(?string $itemTitle): void
    {
        $this->itemTitle = $itemTitle;
    }

    public function getItemWeight(): ?float
    {
        return $this->itemWeight;
    }

    public function setItemWeight(?float $itemWeight): void
    {
        $this->itemWeight = $itemWeight;
    }

    public function getItemXmlDate(): ?DateTimeInterface
    {
        return $this->itemXmlDate;
    }

    public function setItemXmlDate(?DateTimeInterface $itemXmlDate): void
    {
        $this->itemXmlDate = $itemXmlDate;
    }

    public function getPlatformTaxReference(): ?string
    {
        return $this->platformTaxReference;
    }

    public function setPlatformTaxReference(?string $platformTaxReference): void
    {
        $this->platformTaxReference = $platformTaxReference;
    }

    public function getTaxCollectedBy(): ?TaxCollectedByEnum
    {
        return $this->taxCollectedByEnum;
    }

    public function setTaxCollectedBy(?TaxCollectedByEnum $taxCollectedByEnum): void
    {
        $this->taxCollectedByEnum = $taxCollectedByEnum;
    }

    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    public function setTaxRate(?float $taxRate): void
    {
        $this->taxRate = $taxRate;
    }

    public function getUserDefinedFlag(): ?int
    {
        return $this->userDefinedFlag;
    }

    public function setUserDefinedFlag(?int $userDefinedFlag): void
    {
        $this->userDefinedFlag = $userDefinedFlag;
    }

    public function getEBayFeedbackCompleted(): ?bool
    {
        return $this->eBayFeedbackCompleted;
    }

    public function setEBayFeedbackCompleted(?bool $eBayFeedbackCompleted): void
    {
        $this->eBayFeedbackCompleted = $eBayFeedbackCompleted;
    }

    public function getEBayFeedbackReceived(): ?bool
    {
        return $this->eBayFeedbackReceived;
    }

    public function setEBayFeedbackReceived(?bool $eBayFeedbackReceived): void
    {
        $this->eBayFeedbackReceived = $eBayFeedbackReceived;
    }

    public function getEBayFeedbackType(): ?string
    {
        return $this->eBayFeedbackType;
    }

    public function setEBayFeedbackType(?string $eBayFeedbackType): void
    {
        $this->eBayFeedbackType = $eBayFeedbackType;
    }

    public function getInternalItemTypeEnum(): ?InternalItemTypeEnum
    {
        return $this->internalItemTypeEnum;
    }

    public function setInternalItemTypeEnum(?InternalItemTypeEnum $internalItemTypeEnum): void
    {
        $this->internalItemTypeEnum = $internalItemTypeEnum;
    }

    public function getItemLink(): ?string
    {
        return $this->itemLink;
    }

    public function setItemLink(?string $itemLink): void
    {
        $this->itemLink = $itemLink;
    }

    public function getItemPlatFormName(): ?ItemPlatFormNameEnum
    {
        return $this->itemPlatFormNameEnum;
    }

    public function setItemPlatFormName(?ItemPlatFormNameEnum $itemPlatFormNameEnum): void
    {
        $this->itemPlatFormNameEnum = $itemPlatFormNameEnum;
    }

    public function getItemOriginalCurrency(): ?ItemOriginalCurrency
    {
        return $this->itemOriginalCurrency;
    }

    public function setItemOriginalCurrency(?ItemOriginalCurrency $itemOriginalCurrency): void
    {
        $this->itemOriginalCurrency = $itemOriginalCurrency;
    }

    public function getShopProductDetails(): ?ShopProductDetails
    {
        return $this->shopProductDetails;
    }

    public function setShopProductDetails(?ShopProductDetails $shopProductDetails): void
    {
        $this->shopProductDetails = $shopProductDetails;
    }
}
