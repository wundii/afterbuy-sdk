<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class PartsProperty implements ResponseDtoInterface
{
    public function __construct(
        private string $propertyName,
        private string $propertyValue,
    ) {
    }

    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    public function setPropertyName(string $propertyName): void
    {
        $this->propertyName = $propertyName;
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
