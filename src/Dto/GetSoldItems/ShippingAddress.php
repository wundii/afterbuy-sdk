<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ShippingAddress implements ResponseDtoInterface
{
    public function __construct(
        private ?string $firstName = null,
        private ?string $lastName = null,
        private ?string $company = null,
        private ?string $street = null,
        private ?string $street2 = null,
        private ?string $stateOrProvince = null,
        private ?string $postalCode = null,
        private ?string $city = null,
        private ?string $phone = null,
        private ?string $country = null,
        private ?CountryIsoEnum $countryIsoEnum = null,
        private ?string $taxIdNumber = null,
    ) {
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
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

    public function getStateOrProvince(): ?string
    {
        return $this->stateOrProvince;
    }

    public function setStateOrProvince(?string $stateOrProvince): void
    {
        $this->stateOrProvince = $stateOrProvince;
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
}
