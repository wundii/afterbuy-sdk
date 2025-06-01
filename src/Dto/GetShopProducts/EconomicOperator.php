<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class EconomicOperator implements ResponseDtoInterface
{
    public function __construct(
        private ?string $company = null,
        private ?string $street1 = null,
        private ?string $street2 = null,
        private ?string $postalCode = null,
        private ?string $city = null,
        private ?string $stateOrProvince = null,
        private ?CountryIsoEnum $countryIsoEnum = null,
        private ?string $email = null,
        private ?string $phone = null,
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

    public function getCountry(): ?CountryIsoEnum
    {
        return $this->countryIsoEnum;
    }

    public function setCountry(?CountryIsoEnum $countryIsoEnum): void
    {
        $this->countryIsoEnum = $countryIsoEnum;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
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

    public function getStreet1(): ?string
    {
        return $this->street1;
    }

    public function setStreet1(?string $street1): void
    {
        $this->street1 = $street1;
    }

    public function getStreet2(): ?string
    {
        return $this->street2;
    }

    public function setStreet2(?string $street2): void
    {
        $this->street2 = $street2;
    }
}
