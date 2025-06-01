<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use DateTimeInterface;
use Wundii\AfterbuySdk\Enum\PaymentFunctionEnum;
use Wundii\AfterbuySdk\Enum\PaymentIdEnum;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class PaymentInfo implements ResponseDtoInterface
{
    /**
     * @param PayoutId[] $payoutIds
     */
    public function __construct(
        private PaymentIdEnum $paymentIdEnum,
        private ?string $paymentMethod = null,
        private ?PaymentFunctionEnum $paymentFunctionEnum = null,
        private ?string $paymentTransactionId = null,
        private ?string $paymentStatus = null,
        private ?DateTimeInterface $paymentDate = null,
        private ?float $alreadyPaid = null,
        private ?float $fullAmount = null,
        private ?DateTimeInterface $invoiceDate = null,
        private ?string $paymentInstruction = null,
        private ?string $eftid = null,
        private array $payoutIds = [],
        private ?PaymentData $paymentData = null,
    ) {
    }

    public function getAlreadyPaid(): ?float
    {
        return $this->alreadyPaid;
    }

    public function setAlreadyPaid(?float $alreadyPaid): void
    {
        $this->alreadyPaid = $alreadyPaid;
    }

    public function getEftid(): ?string
    {
        return $this->eftid;
    }

    public function setEftid(?string $eftid): void
    {
        $this->eftid = $eftid;
    }

    public function getFullAmount(): ?float
    {
        return $this->fullAmount;
    }

    public function setFullAmount(?float $fullAmount): void
    {
        $this->fullAmount = $fullAmount;
    }

    public function getInvoiceDate(): ?DateTimeInterface
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(?DateTimeInterface $invoiceDate): void
    {
        $this->invoiceDate = $invoiceDate;
    }

    public function getPaymentData(): ?PaymentData
    {
        return $this->paymentData;
    }

    public function setPaymentData(?PaymentData $paymentData): void
    {
        $this->paymentData = $paymentData;
    }

    public function getPaymentDate(): ?DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(?DateTimeInterface $paymentDate): void
    {
        $this->paymentDate = $paymentDate;
    }

    public function getPaymentFunction(): ?PaymentFunctionEnum
    {
        return $this->paymentFunctionEnum;
    }

    public function setPaymentFunction(?PaymentFunctionEnum $paymentFunctionEnum): void
    {
        $this->paymentFunctionEnum = $paymentFunctionEnum;
    }

    public function getPaymentId(): PaymentIdEnum
    {
        return $this->paymentIdEnum;
    }

    public function setPaymentId(PaymentIdEnum $paymentIdEnum): void
    {
        $this->paymentIdEnum = $paymentIdEnum;
    }

    public function getPaymentInstruction(): ?string
    {
        return $this->paymentInstruction;
    }

    public function setPaymentInstruction(?string $paymentInstruction): void
    {
        $this->paymentInstruction = $paymentInstruction;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?string $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(?string $paymentStatus): void
    {
        $this->paymentStatus = $paymentStatus;
    }

    public function getPaymentTransactionId(): ?string
    {
        return $this->paymentTransactionId;
    }

    public function setPaymentTransactionId(?string $paymentTransactionId): void
    {
        $this->paymentTransactionId = $paymentTransactionId;
    }

    /**
     * @return PayoutId[]
     */
    public function getPayoutIds(): array
    {
        return $this->payoutIds;
    }

    /**
     * @param PayoutId[] $payoutIds
     */
    public function setPayoutIds(array $payoutIds): void
    {
        $this->payoutIds = $payoutIds;
    }
}
