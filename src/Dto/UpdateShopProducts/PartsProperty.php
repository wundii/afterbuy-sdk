<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Enum\PropertyNameEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class PartsProperty implements AfterbuyAppendXmlContentInterface
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
