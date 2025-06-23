<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetProductDiscounts;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of product discounts.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class ProductDiscounts implements ResponseDtoInterface
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
