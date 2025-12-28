<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Variation;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\VariationValue;

class VariationTest extends TestCase
{
    public function testConstructor(): void
    {
        $variation = new Variation(
            variationName: 'Grösse',
            variationValues: [
                new VariationValue(
                    validForProdId: 123456789,
                    variationValue: 'XXL',
                    variationPos: 1,
                    variationPicUrl: 'https://www.afterbuy.de/homesites/images/home/logo.gif',
                ),
            ],
        );

        $this->assertSame('Grösse', $variation->getVariationName());
        $values = $variation->getVariationValues();
        $this->assertCount(1, $values);
        $variationValue = $values[0];
        $this->assertInstanceOf(VariationValue::class, $variationValue);
        $this->assertSame(123456789, $variationValue->getValidForProdId());
        $this->assertSame('XXL', $variationValue->getVariationValue());
        $this->assertSame(1, $variationValue->getVariationPos());
        $this->assertSame('https://www.afterbuy.de/homesites/images/home/logo.gif', $variationValue->getVariationPicUrl());
    }
}
