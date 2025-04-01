<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Enum\CountryIsoEnum;
use AfterbuySdk\Interface\AfterbuyDtoInterface;

final readonly class ShippingAddress implements AfterbuyDtoInterface
{
    public function __construct(
        private ?bool $useShippingAddress = null,
        private ?string $firstName = null,
        private ?string $lastName = null,
        private ?string $company = null,
        private ?string $street = null,
        private ?string $street2 = null,
        private ?string $stateOrProvince = null,
        private ?string $phone = null,
        private ?string $postalCode = null,
        private ?string $city = null,
        private ?string $country = null,
        private ?CountryIsoEnum $countryIsoEnum = null,
    ) {
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getCountryIso(): ?CountryIsoEnum
    {
        return $this->countryIsoEnum;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getStateOrProvince(): ?string
    {
        return $this->stateOrProvince;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getStreet2(): ?string
    {
        return $this->street2;
    }

    public function getUseShippingAddress(): ?bool
    {
        return $this->useShippingAddress;
    }
}
