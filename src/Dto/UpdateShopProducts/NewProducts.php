<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

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
