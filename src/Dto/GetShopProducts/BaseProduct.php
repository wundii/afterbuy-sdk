<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class BaseProduct implements ResponseDtoInterface
{
    public function __construct(
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
