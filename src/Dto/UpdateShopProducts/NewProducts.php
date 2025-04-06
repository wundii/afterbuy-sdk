<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Interface\AfterbuyDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class NewProducts implements AfterbuyDtoInterface
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
