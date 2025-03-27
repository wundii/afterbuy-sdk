<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetSoldItems;

use AfterbuySdk\Enum\CountryIsoEnum;
use AfterbuySdk\Enum\UserIdPlattformEnum;
use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class BillingAddress implements AfterbuyDtoInterface
{
    public function __construct(
        private int $afterbuyUserId,
        private ?int $afterbuyUserIdAlt = null,
        private ?UserIdPlattformEnum $userIdPlattformEnum = null,
        private ?string $firstName = null,
        private ?string $lastName = null,
        private ?string $title = null,
        private ?string $company = null,
        private ?string $street = null,
        private ?string $street2 = null,
        private ?string $postalCode = null,
        private ?string $city = null,
        private ?string $country = null,
        private ?CountryIsoEnum $countryIsoEnum = null,
        private ?string $phone = null,
        private ?string $fax = null,
        private ?string $mail = null,
        private bool $isMerchant = false,
        private ?string $taxIdNumber = null,
    ) {
    }

    public function getAfterbuyUserId(): int
    {
        return $this->afterbuyUserId;
    }

    public function setAfterbuyUserId(int $afterbuyUserId): void
    {
        $this->afterbuyUserId = $afterbuyUserId;
    }

    public function getAfterbuyUserIdAlt(): ?int
    {
        return $this->afterbuyUserIdAlt;
    }

    public function setAfterbuyUserIdAlt(?int $afterbuyUserIdAlt): void
    {
        $this->afterbuyUserIdAlt = $afterbuyUserIdAlt;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    public function getCountryIso(): ?CountryIsoEnum
    {
        return $this->countryIsoEnum;
    }

    public function setCountryIso(?CountryIsoEnum $countryIsoEnum): void
    {
        $this->countryIsoEnum = $countryIsoEnum;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): void
    {
        $this->fax = $fax;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function isMerchant(): bool
    {
        return $this->isMerchant;
    }

    public function setIsMerchant(bool $isMerchant): void
    {
        $this->isMerchant = $isMerchant;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): void
    {
        $this->mail = $mail;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getStreet2(): ?string
    {
        return $this->street2;
    }

    public function setStreet2(?string $street2): void
    {
        $this->street2 = $street2;
    }

    public function getTaxIdNumber(): ?string
    {
        return $this->taxIdNumber;
    }

    public function setTaxIdNumber(?string $taxIdNumber): void
    {
        $this->taxIdNumber = $taxIdNumber;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getUserIdPlattformEnum(): ?UserIdPlattformEnum
    {
        return $this->userIdPlattformEnum;
    }

    public function setUserIdPlattformEnum(?UserIdPlattformEnum $userIdPlattformEnum): void
    {
        $this->userIdPlattformEnum = $userIdPlattformEnum;
    }
}
