<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class DeliveryAddress implements RequestDtoArrayInterface
{
    use ShopApiTrait;

    public function __construct(
        #[Assert\Length(min: 1, max: 255)]
        public string $firstName,
        #[Assert\Length(min: 1, max: 255)]
        public string $lastName,
        #[Assert\Length(min: 1, max: 255)]
        public string $street1,
        #[Assert\Length(min: 1, max: 255)]
        public string $zip,
        #[Assert\Length(min: 1, max: 255)]
        public string $city,
        public CountryIsoEnum $countryIsoEnum,
        #[Assert\Length(max: 255)]
        public ?string $company = null,
        #[Assert\Length(max: 255)]
        public ?string $street2 = null,
        #[Assert\Length(max: 255)]
        public ?string $phone = null,
        public ?Customer $customerAddressCheck = null,
    ) {
    }

    public function isCustomerAddressDifferent(Customer $customer): bool
    {
        return $this->firstName !== $customer->firstName
            || $this->lastName !== $customer->lastName
            || $this->street1 !== $customer->street1
            || $this->zip !== $customer->zip
            || $this->city !== $customer->city
            || $this->countryIsoEnum !== $customer->countryIsoEnum
            || $this->company !== $customer->company
            || $this->street2 !== $customer->street2;
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data, ?int $index = null): array
    {
        if (
            $this->customerAddressCheck instanceof Customer
            && ! $this->isCustomerAddressDifferent($this->customerAddressCheck)
        ) {
            return $data;
        }

        $data = $this->addBool($data, 'Lieferanschrift', true);
        $data = $this->addString($data, 'KLFirma', $this->company);
        $data = $this->addString($data, 'KLVorname', $this->firstName);
        $data = $this->addString($data, 'KLNachname', $this->lastName);
        $data = $this->addString($data, 'KLStrasse', $this->street1);
        $data = $this->addString($data, 'KLStrasse2', $this->street2);
        $data = $this->addString($data, 'KLPLZ', $this->zip);
        $data = $this->addString($data, 'KLOrt', $this->city);
        $data = $this->addString($data, 'KLLand', $this->countryIsoEnum->value);
        return $this->addString($data, 'KLTelefon', $this->phone);
    }
}
