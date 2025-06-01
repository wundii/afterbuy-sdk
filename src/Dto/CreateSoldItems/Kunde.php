<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateSoldItems;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class Kunde implements RequestDtoArrayInterface
{
    use ShopApiTrait;

    public function __construct(
        #[Assert\Length(min: 1, max: 50)]
        public string $kbenutzername,
    ) {
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data): array
    {
        return $this->addString($data, 'kbenutzername', $this->kbenutzername);
    }
}
