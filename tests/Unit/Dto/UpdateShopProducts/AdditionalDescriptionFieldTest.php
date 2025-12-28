<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AdditionalDescriptionField;

class AdditionalDescriptionFieldTest extends TestCase
{
    public function testConstructor(): void
    {
        $additionalDescriptionField = new AdditionalDescriptionField(
            fieldIdIdent: 10,
            fieldNameIdent: 'FieldNameIdent - 10',
            fieldName: 'Name - 10',
            fieldLabel: 'Label - 10',
            fieldContent: 'Content - 10',
        );

        $this->assertSame(10, $additionalDescriptionField->getFieldIdIdent());
        $this->assertSame('FieldNameIdent - 10', $additionalDescriptionField->getFieldNameIdent());
        $this->assertSame('Name - 10', $additionalDescriptionField->getFieldName());
        $this->assertSame('Label - 10', $additionalDescriptionField->getFieldLabel());
        $this->assertSame('Content - 10', $additionalDescriptionField->getFieldContent());
    }

    public function testException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AdditionalDescriptionField();
    }
}
