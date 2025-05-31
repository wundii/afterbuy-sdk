<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateSoldItems;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\AfterbuyShopApiTrait;

final readonly class Order implements AfterbuyRequestDtoArrayInterface
{
    use AfterbuyShopApiTrait;

    public function __construct(
        #[Assert\Valid]
        public Kunde $kunde,
        #[Assert\Valid]
        public ?Lieferadresse $lieferadresse = null,
    ) {
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data): array
    {
        $data = $this->addObject($data, $this->kunde);
        return $this->addObject($data, $this->lieferadresse);
    }
}
