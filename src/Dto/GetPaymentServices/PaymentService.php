<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetPaymentServices;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class PaymentService implements ResponseDtoInterface
{
    public function __construct(
        private int $paymentId,
        private int $paymentFunctionId,
        private string $name,
        private ?string $standardText = null,
        private int $position = 0,
        private int $level = 0,
        private float $surcharge = 0,
        private float $surchargePercent = 0,
        private float $minAmount = 0,
        private float $maxAmount = 0,
        private ?string $plattformName = null,
        private bool $standardForAll = false,
        private bool $default = false,
        private ?string $countryGroup = null,
        private ?string $countryGroupCountries = null,
    ) {
    }

    public function getCountryGroup(): ?string
    {
        return $this->countryGroup;
    }

    public function setCountryGroup(?string $countryGroup): void
    {
        $this->countryGroup = $countryGroup;
    }

    public function isDefault(): bool
    {
        return $this->default;
    }

    public function setDefault(bool $default): void
    {
        $this->default = $default;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getMaxAmount(): float
    {
        return $this->maxAmount;
    }

    public function setMaxAmount(float $maxAmount): void
    {
        $this->maxAmount = $maxAmount;
    }

    public function getMinAmount(): float
    {
        return $this->minAmount;
    }

    public function setMinAmount(float $minAmount): void
    {
        $this->minAmount = $minAmount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPaymentFunctionId(): int
    {
        return $this->paymentFunctionId;
    }

    public function setPaymentFunctionId(int $paymentFunctionId): void
    {
        $this->paymentFunctionId = $paymentFunctionId;
    }

    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    public function setPaymentId(int $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    public function getPlattformName(): ?string
    {
        return $this->plattformName;
    }

    public function setPlattformName(?string $plattformName): void
    {
        $this->plattformName = $plattformName;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function isStandardForAll(): bool
    {
        return $this->standardForAll;
    }

    public function setStandardForAll(bool $standardForAll): void
    {
        $this->standardForAll = $standardForAll;
    }

    public function getStandardText(): ?string
    {
        return $this->standardText;
    }

    public function setStandardText(?string $standardText): void
    {
        $this->standardText = $standardText;
    }

    public function getSurcharge(): float
    {
        return $this->surcharge;
    }

    public function setSurcharge(float $surcharge): void
    {
        $this->surcharge = $surcharge;
    }

    public function getSurchargePercent(): float
    {
        return $this->surchargePercent;
    }

    public function setSurchargePercent(float $surchargePercent): void
    {
        $this->surchargePercent = $surchargePercent;
    }

    public function getCountryGroupCountries(): ?string
    {
        return $this->countryGroupCountries;
    }

    public function setCountryGroupCountries(?string $countryGroupCountries): void
    {
        $this->countryGroupCountries = $countryGroupCountries;
    }
}
