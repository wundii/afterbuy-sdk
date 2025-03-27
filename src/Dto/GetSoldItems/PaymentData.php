<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetSoldItems;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class PaymentData implements AfterbuyDtoInterface
{
    public function __construct(
        private ?string $bankCode = null,
        private ?string $accountHolder = null,
        private ?string $bankName = null,
        private ?string $accountNumber = null,
        private ?string $iban = null,
        private ?string $bic = null,
        private ?string $referenceNumber = null,
    ) {
    }

    public function getAccountHolder(): ?string
    {
        return $this->accountHolder;
    }

    public function setAccountHolder(?string $accountHolder): void
    {
        $this->accountHolder = $accountHolder;
    }

    public function getAccountNumber(): ?string
    {
        return $this->accountNumber;
    }

    public function setAccountNumber(?string $accountNumber): void
    {
        $this->accountNumber = $accountNumber;
    }

    public function getBankCode(): ?string
    {
        return $this->bankCode;
    }

    public function setBankCode(?string $bankCode): void
    {
        $this->bankCode = $bankCode;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function setBankName(?string $bankName): void
    {
        $this->bankName = $bankName;
    }

    public function getBic(): ?string
    {
        return $this->bic;
    }

    public function setBic(?string $bic): void
    {
        $this->bic = $bic;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(?string $iban): void
    {
        $this->iban = $iban;
    }

    public function getReferenceNumber(): ?string
    {
        return $this->referenceNumber;
    }

    public function setReferenceNumber(?string $referenceNumber): void
    {
        $this->referenceNumber = $referenceNumber;
    }
}
