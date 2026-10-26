<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\Structron\Attribute\Description;

final class BaseProduct implements ResponseDtoInterface
{
    public function __construct(
        #[Description('BaseProductFlag 1/2: ProductID of the product contained in the set; BaseProductFlag 3: ProductID of the set this product belongs to')]
        private int $baseProductID,
        private int $baseProductType,
        private ?BaseProductsRelationData $baseProductsRelationData = null,
    ) {
    }

    public function getBaseProductID(): int
    {
        return $this->baseProductID;
    }

    public function setBaseProductID(int $baseProductID): void
    {
        $this->baseProductID = $baseProductID;
    }

    public function getBaseProductsRelationData(): ?BaseProductsRelationData
    {
        return $this->baseProductsRelationData;
    }

    public function setBaseProductsRelationData(?BaseProductsRelationData $baseProductsRelationData): void
    {
        $this->baseProductsRelationData = $baseProductsRelationData;
    }

    public function getBaseProductType(): int
    {
        return $this->baseProductType;
    }

    public function setBaseProductType(int $baseProductType): void
    {
        $this->baseProductType = $baseProductType;
    }
}
