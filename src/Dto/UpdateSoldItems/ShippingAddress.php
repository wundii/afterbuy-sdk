<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateSoldItems;

use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class ShippingAddress implements RequestDtoXmlInterface
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

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $shippingAddress = $simpleXml->addChild('ShippingAddress');
        $shippingAddress->addBool('UseShippingAddress', $this->useShippingAddress);
        $shippingAddress->addString('FirstName', $this->firstName);
        $shippingAddress->addString('LastName', $this->lastName);
        $shippingAddress->addString('Company', $this->company);
        $shippingAddress->addString('Street', $this->street);
        $shippingAddress->addString('Street2', $this->street2);
        $shippingAddress->addString('StateOrProvince', $this->stateOrProvince);
        $shippingAddress->addString('Phone', $this->phone);
        $shippingAddress->addString('PostalCode', $this->postalCode);
        $shippingAddress->addString('City', $this->city);
        $shippingAddress->addString('Country', $this->country);
        $shippingAddress->addString('CountryISO', $this->countryIsoEnum?->value);
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
