<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Interface\AfterbuyDtoInterface;
use DateTimeInterface;

final readonly class PaymentInfo implements AfterbuyDtoInterface
{
    public function __construct(
        private ?string $paymentMethod = null,
        private ?DateTimeInterface $paymentDate = null,
        private ?string $paymentTransactionId = null,
        private ?float $alreadyPaid = null,
        private ?float $paymentAdditionalCost = null,
        private ?float $sendPaymentMail = null,
    ) {
    }

    public function getAlreadyPaid(): ?float
    {
        return $this->alreadyPaid;
    }

    public function getPaymentAdditionalCost(): ?float
    {
        return $this->paymentAdditionalCost;
    }

    public function getPaymentDate(): ?DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function getPaymentTransactionId(): ?string
    {
        return $this->paymentTransactionId;
    }

    public function getSendPaymentMail(): ?float
    {
        return $this->sendPaymentMail;
    }
}
