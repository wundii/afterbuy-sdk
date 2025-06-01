<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateSoldItems;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class Lieferadresse implements RequestDtoArrayInterface
{
    use ShopApiTrait;

    public function __construct(
        #[Assert\Length(min: 1, max: 255)]
        public string $vorname,
        #[Assert\Length(min: 1, max: 255)]
        public string $nachname,
        #[Assert\Length(min: 1, max: 255)]
        public string $strasse,
        #[Assert\Length(min: 1, max: 255)]
        public string $plz,
        #[Assert\Length(min: 1, max: 255)]
        public string $ort,
        public CountryIsoEnum $land,
        #[Assert\Length(max: 255)]
        public ?string $firma = null,
        #[Assert\Length(max: 255)]
        public ?string $strasse2 = null,
        #[Assert\Length(max: 255)]
        public ?string $telefon = null,
    ) {
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data): array
    {
        $data = $this->addBool($data, 'Lieferanschrift', true);
        $data = $this->addString($data, 'KLFirma', $this->firma);
        $data = $this->addString($data, 'KLVorname', $this->vorname);
        $data = $this->addString($data, 'KLNachname', $this->nachname);
        $data = $this->addString($data, 'KLStrasse', $this->strasse);
        $data = $this->addString($data, 'KLStrasse2', $this->strasse2);
        $data = $this->addString($data, 'KLPLZ', $this->plz);
        $data = $this->addString($data, 'KLOrt', $this->ort);
        $data = $this->addString($data, 'KLLand', $this->land->value);
        return $this->addString($data, 'KLTelefon', $this->telefon);
    }
}
