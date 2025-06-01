<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class Kunde implements RequestDtoArrayInterface
{
    use ShopApiTrait;

    public function __construct(
        #[Assert\Length(min: 1, max: 50)]
        public string $benutzername,
        #[Assert\Length(min: 1, max: 150)]
        public string $email,
        #[Assert\Length(min: 1, max: 150)]
        public string $vorname,
        #[Assert\Length(min: 1, max: 150)]
        public string $nachname,
        #[Assert\Length(min: 1, max: 150)]
        public string $strasse,
        #[Assert\Length(min: 1, max: 150)]
        public string $plz,
        #[Assert\Length(min: 1, max: 150)]
        public string $ort,
        public CountryIsoEnum $land,
        #[Assert\Length(max: 150)]
        public ?string $anrede = null,
        #[Assert\Length(max: 150)]
        public ?string $firma = null,
        #[Assert\Length(max: 150)]
        public ?string $strasse2 = null,
        #[Assert\Length(max: 150)]
        public ?string $bundesland = null,
        #[Assert\Length(max: 150)]
        public ?string $telefon = null,
        #[Assert\Length(max: 50)]
        public ?string $fax = null,
        public ?DateTimeInterface $geburtsdatum = null,
    ) {
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data): array
    {
        $data = $this->addString($data, 'kbenutzername', $this->benutzername);
        $data = $this->addString($data, 'Kanrede', $this->anrede);
        $data = $this->addString($data, 'KFirma', $this->firma);
        $data = $this->addString($data, 'KVorname', $this->vorname);
        $data = $this->addString($data, 'KNachname', $this->nachname);
        $data = $this->addString($data, 'KStrasse', $this->strasse);
        $data = $this->addString($data, 'KStrasse2', $this->strasse2);
        $data = $this->addString($data, 'KPLZ', $this->plz);
        $data = $this->addString($data, 'KOrt', $this->ort);
        $data = $this->addString($data, 'KBundesland', $this->bundesland);
        $data = $this->addString($data, 'Ktelefon', $this->telefon);
        $data = $this->addString($data, 'Kfax', $this->fax);
        $data = $this->addString($data, 'Kemail', $this->email);
        $data = $this->addString($data, 'KLand', $this->land->value);
        return $this->addDateTime($data, 'KBirthday', $this->geburtsdatum);
    }
}
