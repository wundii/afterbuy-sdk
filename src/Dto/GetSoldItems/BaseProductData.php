<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetSoldItems;

use AfterbuySdk\Enum\BaseProductTypeEnum;
use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class BaseProductData implements AfterbuyDtoInterface
{
    /**
     * @param ChildProduct[] $childProduct
     */
    public function __construct(
        private BaseProductTypeEnum $baseProductTypeEnum,
        private array $childProduct = [],
    ) {
    }

    public function getBaseProductType(): BaseProductTypeEnum
    {
        return $this->baseProductTypeEnum;
    }

    public function setBaseProductType(BaseProductTypeEnum $baseProductTypeEnum): void
    {
        $this->baseProductTypeEnum = $baseProductTypeEnum;
    }

    /**
     * @return ChildProduct[]
     */
    public function getChildProduct(): array
    {
        return $this->childProduct;
    }

    public function setChildProduct(?ChildProduct $childProduct): void
    {
        if (! $childProduct instanceof ChildProduct) {
            return;
        }

        $this->childProduct[] = $childProduct;
    }
}
