<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AdditionalPriceUpdate;

class AdditionalDescriptionFieldTest extends TestCase
{
    public function testConstructor(): void
    {
        $additionalDescriptionField = new AdditionalPriceUpdate(
            definitionId: 1,
            productId: 123456,
            price: 1.23,
        );

        $this->assertSame(1, $additionalDescriptionField->getDefinitionId());
        $this->assertSame(123456, $additionalDescriptionField->getProductId());
        $this->assertSame(1.23, $additionalDescriptionField->getPrice());
    }
}
