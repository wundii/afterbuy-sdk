<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class Order implements RequestDtoArrayInterface
{
    use ShopApiTrait;

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
        /**
         * PosAnz
         */

        $data = $this->addObject($data, $this->kunde);
        return $this->addObject($data, $this->lieferadresse);
    }
}
