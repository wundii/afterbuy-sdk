<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\PartsProperties;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\PartsProperty;
use Wundii\AfterbuySdk\Enum\PropertyNameEnum;

class PartsPropertiesTest extends TestCase
{
    public function testConstructor(): void
    {
        $partsProperties = new PartsProperties(
            [
                new PartsProperty(
                    propertyNameEnum: PropertyNameEnum::KType,
                    propertyValue: '3313',
                ),
                new PartsProperty(
                    propertyNameEnum: PropertyNameEnum::KType,
                    propertyValue: '3314',
                ),
                new PartsProperty(
                    propertyNameEnum: PropertyNameEnum::HSN,
                    propertyValue: '7107',
                ),
                new PartsProperty(
                    propertyNameEnum: PropertyNameEnum::TSN,
                    propertyValue: '449',
                ),
                new PartsProperty(
                    propertyNameEnum: PropertyNameEnum::TSN,
                    propertyValue: '450',
                ),
            ],
        );

        $properties = $partsProperties->getPartsProperties();
        $this->assertCount(5, $properties);
        $property = $properties[0];
        $this->assertInstanceOf(PartsProperty::class, $property);
        $this->assertSame(PropertyNameEnum::KType, $property->getPropertyName());
        $this->assertSame('3313', $property->getPropertyValue());
    }

    public function testException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new PartsProperties(
            [],
        );
    }
}
