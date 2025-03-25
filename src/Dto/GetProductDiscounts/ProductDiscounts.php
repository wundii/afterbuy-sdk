<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetProductDiscounts;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ProductDiscounts implements AfterbuyDtoInterface
{
    /**
     * @param ProductDiscount[] $productDiscounts
     */
    public function __construct(
        private array $productDiscounts = [],
    ) {
    }

    /**
     * @return ProductDiscount[]
     */
    public function getProductDiscounts(): array
    {
        return $this->productDiscounts;
    }

    /**
     * @param ProductDiscount[] $productDiscounts
     */
    public function setProductDiscounts(array $productDiscounts): void
    {
        $this->productDiscounts = $productDiscounts;
    }
}
