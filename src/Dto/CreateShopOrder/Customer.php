<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class Customer implements RequestDtoArrayInterface
{
    use ShopApiTrait;

    public function __construct(
        #[Assert\Length(min: 1, max: 50)]
        public string $username,
        #[Assert\Length(min: 1, max: 150)]
        public string $email,
        #[Assert\Length(min: 1, max: 150)]
        public string $firstName,
        #[Assert\Length(min: 1, max: 150)]
        public string $lastName,
        #[Assert\Length(min: 1, max: 150)]
        public string $street1,
        #[Assert\Length(min: 1, max: 150)]
        public string $zip,
        #[Assert\Length(min: 1, max: 150)]
        public string $city,
        public CountryIsoEnum $countryIsoEnum,
        #[Assert\Length(max: 150)]
        public ?string $salutation = null,
        #[Assert\Length(max: 150)]
        public ?string $company = null,
        #[Assert\Length(max: 150)]
        public ?string $street2 = null,
        #[Assert\Length(max: 150)]
        public ?string $state = null,
        #[Assert\Length(max: 150)]
        public ?string $phone = null,
        #[Assert\Length(max: 50)]
        public ?string $fax = null,
        public ?DateTimeInterface $birthday = null,
    ) {
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data, ?int $index = null): array
    {
        $data = $this->addString($data, 'kbenutzername', $this->username);
        $data = $this->addString($data, 'Kanrede', $this->salutation);
        $data = $this->addString($data, 'KFirma', $this->company);
        $data = $this->addString($data, 'KVorname', $this->firstName);
        $data = $this->addString($data, 'KNachname', $this->lastName);
        $data = $this->addString($data, 'KStrasse', $this->street1);
        $data = $this->addString($data, 'KStrasse2', $this->street2);
        $data = $this->addString($data, 'KPLZ', $this->zip);
        $data = $this->addString($data, 'KOrt', $this->city);
        $data = $this->addString($data, 'KBundesland', $this->state);
        $data = $this->addString($data, 'Ktelefon', $this->phone);
        $data = $this->addString($data, 'Kfax', $this->fax);
        $data = $this->addString($data, 'Kemail', $this->email);
        $data = $this->addString($data, 'KLand', $this->countryIsoEnum->value);
        return $this->addDateTime($data, 'KBirthday', $this->birthday);
    }
}
