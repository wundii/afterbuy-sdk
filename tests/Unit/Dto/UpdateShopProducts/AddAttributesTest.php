<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddAttribut;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddAttributes;
use Wundii\AfterbuySdk\Enum\AttributTypEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionAttributesEnum;

class AddAttributesTest extends TestCase
{
    public function testConstructor(): void
    {
        $addAttributes = new AddAttributes(
            updateActionAttributesEnum: UpdateActionAttributesEnum::ADD_OR_UPDATE,
            addAttributes: [
                new AddAttribut(
                    attributName: 'Attribut',
                    attributValue: '1;2;3;4',
                    attributTypEnum: AttributTypEnum::DROPDOWN,
                    attributPosition: 1000,
                    attributRequired: true,
                ),
            ],
        );

        $this->assertSame(UpdateActionAttributesEnum::ADD_OR_UPDATE, $addAttributes->getUpdateAction());
        $attributes = $addAttributes->getAddAttributes();
        $this->assertCount(1, $attributes);
        $addAttribute = $attributes[0];
        $this->assertInstanceOf(AddAttribut::class, $addAttribute);
        $this->assertSame('Attribut', $addAttribute->getAttributName());
        $this->assertSame('1;2;3;4', $addAttribute->getAttributValue());
        $this->assertSame(AttributTypEnum::DROPDOWN, $addAttribute->getAttributTyp());
        $this->assertSame(1000, $addAttribute->getAttributPosition());
        $this->assertTrue($addAttribute->getAttributRequired());
    }

    public function testException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new AddAttributes(
            updateActionAttributesEnum: UpdateActionAttributesEnum::ADD_OR_UPDATE,
            addAttributes: [],
        );
    }
}
