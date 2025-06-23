<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of payment services.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class NewProducts implements ResponseDtoInterface
{
    /**
     * @param NewProduct[] $newProducts
     */
    public function __construct(
        private array $newProducts = [],
    ) {
    }

    /**
     * @return NewProduct[]
     */
    #[Assert\Valid]
    public function getNewProducts(): array
    {
        return $this->newProducts;
    }

    /**
     * @param NewProduct[] $newProducts
     */
    public function setNewProducts(array $newProducts): void
    {
        $this->newProducts = $newProducts;
    }
}
