<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Enum\PropertyNameEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestDtoInterface;

final readonly class PartsProperty implements AfterbuyRequestDtoInterface
{
    public function __construct(
        private PropertyNameEnum $propertyNameEnum,
        private string $propertyValue,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $partsProperty = $xml->addChild('PartsProperty');
        $partsProperty->addString('PropertyName', $this->propertyNameEnum->value);
        $partsProperty->addString('PropertyValue', $this->propertyValue);
    }

    public function getPropertyName(): PropertyNameEnum
    {
        return $this->propertyNameEnum;
    }

    public function getPropertyValue(): string
    {
        return $this->propertyValue;
    }
}
