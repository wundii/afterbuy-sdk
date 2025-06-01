<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Enum\PropertyNameEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class PartsProperty implements RequestDtoXmlInterface
{
    public function __construct(
        private PropertyNameEnum $propertyNameEnum,
        private string $propertyValue,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $partsProperty = $simpleXml->addChild('PartsProperty');
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
