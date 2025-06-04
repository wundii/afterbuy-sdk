<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Enum\PropertyNameEnum;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class PartsProperty implements ResponseDtoInterface
{
    public function __construct(
        private PropertyNameEnum $propertyNameEnum,
        private string $propertyValue,
    ) {
    }

    public function getPropertyName(): PropertyNameEnum
    {
        return $this->propertyNameEnum;
    }

    public function setPropertyName(PropertyNameEnum $propertyNameEnum): void
    {
        $this->propertyNameEnum = $propertyNameEnum;
    }

    public function getPropertyValue(): string
    {
        return $this->propertyValue;
    }

    public function setPropertyValue(string $propertyValue): void
    {
        $this->propertyValue = $propertyValue;
    }
}
