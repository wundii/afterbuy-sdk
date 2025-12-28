<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\ScaledDiscount;

class ScaledDiscountTest extends TestCase
{
    public function testConstructor(): void
    {
        $scaledDiscount = new ScaledDiscount(
            scaledQuantity: 10,
            scaledPrice: 99.99,
            scaledDPrice: 89.99,
        );

        $this->assertSame(10, $scaledDiscount->getScaledQuantity());
        $this->assertSame(99.99, $scaledDiscount->getScaledPrice());
        $this->assertSame(89.99, $scaledDiscount->getScaledDPrice());
    }
}
