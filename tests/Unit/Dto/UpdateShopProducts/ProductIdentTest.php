<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductIdent;
use Wundii\AfterbuySdk\Enum\BaseProductTypeEnum;

class ProductIdentTest extends TestCase
{
    public function testConstructor(): void
    {
        $productIdent = new ProductIdent(
            userProductId: '12346ABCD',
            baseProductTypeEnum: BaseProductTypeEnum::PRODUCT_SET,
            productInsert: true,
            productId: 0,
            anr: 0,
            ean: 'EAN',
        );

        $this->assertSame('12346ABCD', $productIdent->getUserProductId());
        $this->assertSame(BaseProductTypeEnum::PRODUCT_SET, $productIdent->getBaseProductType());
        $this->assertTrue($productIdent->getProductInsert());
        $this->assertSame(0, $productIdent->getProductId());
        $this->assertSame(0, $productIdent->getAnr());
        $this->assertSame('EAN', $productIdent->getEan());
    }
}
