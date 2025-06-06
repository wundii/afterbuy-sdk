<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use Wundii\AfterbuySdk\Enum\BaseProductTypeEnum;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class BaseProductData implements ResponseDtoInterface
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
