<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use DateTimeInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class Order implements AfterbuyDtoInterface
{
    public function __construct(
        private int $invoiceNumber,
        private int $orderId,
        private int $anr,
        private DateTimeInterface $orderDate,
        private ?PaymentInfo $paymentInfo = null,
        private ?BuyerInfo $buyerInfo = null,
        private ?SoldItems $soldItems = null,
        private ?ShippingInfo $shippingInfo = null,
        private ?OrderOriginalCurrency $orderOriginalCurrency = null,
        private ?DateTimeInterface $feedbackDate = null,
        private ?string $feedbackLink = null,
        private ?int $alternativeItemNumber1 = null,
        private ?string $ebayAccount = null,
        private ?string $amazonAccount = null,
        private ?string $userComment = null,
        private ?string $additionalInfo = null,
        private ?string $trackingLink = null,
        private ?string $memo = null,
        private ?string $invoiceMemo = null,
        private ?int $isCheckoutConfirmedByCustomer = null,
        private ?string $orderIDAlt = null,
        private bool $containsEbayPlusTransaction = false,
    ) {
    }

    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo(?string $additionalInfo): void
    {
        $this->additionalInfo = $additionalInfo;
    }

    public function getAlternativeItemNumber1(): ?int
    {
        return $this->alternativeItemNumber1;
    }

    public function setAlternativeItemNumber1(?int $alternativeItemNumber1): void
    {
        $this->alternativeItemNumber1 = $alternativeItemNumber1;
    }

    public function getAmazonAccount(): ?string
    {
        return $this->amazonAccount;
    }

    public function setAmazonAccount(?string $amazonAccount): void
    {
        $this->amazonAccount = $amazonAccount;
    }

    public function getAnr(): int
    {
        return $this->anr;
    }

    public function setAnr(int $anr): void
    {
        $this->anr = $anr;
    }

    public function getBuyerInfo(): ?BuyerInfo
    {
        return $this->buyerInfo;
    }

    public function setBuyerInfo(BuyerInfo $buyerInfo): void
    {
        $this->buyerInfo = $buyerInfo;
    }

    public function getEbayAccount(): ?string
    {
        return $this->ebayAccount;
    }

    public function setEbayAccount(?string $ebayAccount): void
    {
        $this->ebayAccount = $ebayAccount;
    }

    public function getFeedbackDate(): ?DateTimeInterface
    {
        return $this->feedbackDate;
    }

    public function setFeedbackDate(?DateTimeInterface $feedbackDate): void
    {
        $this->feedbackDate = $feedbackDate;
    }

    public function getInvoiceMemo(): ?string
    {
        return $this->invoiceMemo;
    }

    public function setInvoiceMemo(?string $invoiceMemo): void
    {
        $this->invoiceMemo = $invoiceMemo;
    }

    public function getInvoiceNumber(): int
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(int $invoiceNumber): void
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    public function getIsCheckoutConfirmedByCustomer(): ?int
    {
        return $this->isCheckoutConfirmedByCustomer;
    }

    public function setIsCheckoutConfirmedByCustomer(?int $isCheckoutConfirmedByCustomer): void
    {
        $this->isCheckoutConfirmedByCustomer = $isCheckoutConfirmedByCustomer;
    }

    public function getMemo(): ?string
    {
        return $this->memo;
    }

    public function setMemo(?string $memo): void
    {
        $this->memo = $memo;
    }

    public function getOrderDate(): DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(DateTimeInterface $orderDate): void
    {
        $this->orderDate = $orderDate;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getOrderIDAlt(): ?string
    {
        return $this->orderIDAlt;
    }

    public function setOrderIDAlt(?string $orderIDAlt): void
    {
        $this->orderIDAlt = $orderIDAlt;
    }

    public function getPaymentInfo(): ?PaymentInfo
    {
        return $this->paymentInfo;
    }

    public function setPaymentInfo(PaymentInfo $paymentInfo): void
    {
        $this->paymentInfo = $paymentInfo;
    }

    public function getShippingInfo(): ?ShippingInfo
    {
        return $this->shippingInfo;
    }

    public function setShippingInfo(ShippingInfo $shippingInfo): void
    {
        $this->shippingInfo = $shippingInfo;
    }

    public function getSoldItems(): ?SoldItems
    {
        return $this->soldItems;
    }

    public function setSoldItems(SoldItems $soldItems): void
    {
        $this->soldItems = $soldItems;
    }

    public function getTrackingLink(): ?string
    {
        return $this->trackingLink;
    }

    public function setTrackingLink(?string $trackingLink): void
    {
        $this->trackingLink = $trackingLink;
    }

    public function getUserComment(): ?string
    {
        return $this->userComment;
    }

    public function setUserComment(?string $userComment): void
    {
        $this->userComment = $userComment;
    }

    public function getFeedbackLink(): ?string
    {
        return $this->feedbackLink;
    }

    public function setFeedbackLink(?string $feedbackLink): void
    {
        $this->feedbackLink = $feedbackLink;
    }

    public function isContainsEbayPlusTransaction(): bool
    {
        return $this->containsEbayPlusTransaction;
    }

    public function setContainsEbayPlusTransaction(bool $containsEbayPlusTransaction): void
    {
        $this->containsEbayPlusTransaction = $containsEbayPlusTransaction;
    }

    public function getOrderOriginalCurrency(): ?OrderOriginalCurrency
    {
        return $this->orderOriginalCurrency;
    }

    public function setOrderOriginalCurrency(?OrderOriginalCurrency $orderOriginalCurrency): void
    {
        $this->orderOriginalCurrency = $orderOriginalCurrency;
    }
}
