<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class OrderOriginalCurrency implements ResponseDtoInterface
{
    public function __construct(
        private float $ebayShippingAmount = 0.0,
        private float $shippingAmount = 0.0,
        private float $paymentSurcharge = 0.0,
        private float $paymentSurchargePerCent = 0.0,
        private float $invoiceAmount = 0.0,
        private int $exchangeRate = 0,
        private float $payedAmount = 0.0,
    ) {
    }

    public function getEbayShippingAmount(): float
    {
        return $this->ebayShippingAmount;
    }

    public function setEbayShippingAmount(float $ebayShippingAmount): void
    {
        $this->ebayShippingAmount = $ebayShippingAmount;
    }

    public function getExchangeRate(): int
    {
        return $this->exchangeRate;
    }

    public function setExchangeRate(int $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    public function getInvoiceAmount(): float
    {
        return $this->invoiceAmount;
    }

    public function setInvoiceAmount(float $invoiceAmount): void
    {
        $this->invoiceAmount = $invoiceAmount;
    }

    public function getPayedAmount(): float
    {
        return $this->payedAmount;
    }

    public function setPayedAmount(float $payedAmount): void
    {
        $this->payedAmount = $payedAmount;
    }

    public function getPaymentSurcharge(): float
    {
        return $this->paymentSurcharge;
    }

    public function setPaymentSurcharge(float $paymentSurcharge): void
    {
        $this->paymentSurcharge = $paymentSurcharge;
    }

    public function getPaymentSurchargePerCent(): float
    {
        return $this->paymentSurchargePerCent;
    }

    public function setPaymentSurchargePerCent(float $paymentSurchargePerCent): void
    {
        $this->paymentSurchargePerCent = $paymentSurchargePerCent;
    }

    public function getShippingAmount(): float
    {
        return $this->shippingAmount;
    }

    public function setShippingAmount(float $shippingAmount): void
    {
        $this->shippingAmount = $shippingAmount;
    }
}
