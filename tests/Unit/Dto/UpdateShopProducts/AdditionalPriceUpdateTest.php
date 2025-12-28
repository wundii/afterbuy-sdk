<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AdditionalPriceUpdate;

class AdditionalPriceUpdateTest extends TestCase
{
    public function testConstructor(): void
    {
        $additionalPriceUpdate = new AdditionalPriceUpdate(
            definitionId: 1,
            productId: 123456,
            price: 1.23,
        );

        $this->assertSame(1, $additionalPriceUpdate->getDefinitionId());
        $this->assertSame(123456, $additionalPriceUpdate->getProductId());
        $this->assertSame(1.23, $additionalPriceUpdate->getPrice());
    }
}
