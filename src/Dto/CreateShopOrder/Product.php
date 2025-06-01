<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class Product implements RequestDtoArrayInterface
{
    use ShopApiTrait;

    /**
     * @param string[] $tags
     */
    public function __construct(
        public int $anr,
        #[Assert\Length(min: 1, max: 255)]
        public string $name,
        public float $price,
        public float $vat,
        public int $quantity,
        public ?float $weight = null,
        #[Assert\Length(max: 255)]
        public ?string $productUrl = null,
        #[Assert\Length(max: 255)]
        public ?string $attribute = null,
        public ?int $productId = null,
        #[Assert\Length(max: 100)]
        public ?string $alternativeAnr1 = null,
        #[Assert\Length(max: 20)]
        public ?string $alternativeAnr2 = null,
        #[Assert\Count(min: 0, max: 5)]
        public array $tags = [],
    ) {
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data, ?int $index = null): array
    {
        ++$index;
        $data = $this->addNumber($data, 'Artikelnr_' . $index, $this->anr);
        $data = $this->addString($data, 'AlternArtikelNr1_' . $index, $this->alternativeAnr1);
        $data = $this->addString($data, 'AlternArtikelNr2_' . $index, $this->alternativeAnr2);
        $data = $this->addString($data, 'Artikelname_' . $index, $this->name);
        $data = $this->addNumber($data, 'ArtikelEpreis_' . $index, $this->price);
        $data = $this->addNumber($data, 'ArtikelMwSt_' . $index, $this->vat);
        $data = $this->addNumber($data, 'ArtikelMenge_' . $index, $this->quantity);
        $data = $this->addNumber($data, 'ArtikelGewicht_' . $index, $this->weight);
        $data = $this->addString($data, 'ArtikelLink_' . $index, $this->productUrl);
        $data = $this->addString($data, 'Attribute_' . $index, $this->attribute);
        $data = $this->addNumber($data, 'ArtikelStammID_' . $index, $this->productId);

        foreach ($this->tags as $tagIndex => $tag) {
            ++$tagIndex;
            $key = sprintf('Tag_%s_%s', $tagIndex, $index);
            $data = $this->addString($data, $key, $tag);
        }

        return $data;
    }
}
