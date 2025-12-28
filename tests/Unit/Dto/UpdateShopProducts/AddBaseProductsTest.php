<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddBaseProduct;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddBaseProducts;
use Wundii\AfterbuySdk\Enum\UpdateActionAddBaseProductEnum;

class AddBaseProductsTest extends TestCase
{
    public function testConstructor(): void
    {
        $addBaseProducts = new AddBaseProducts(
            updateActionAddBaseProductEnum: UpdateActionAddBaseProductEnum::UPDATE,
            addBaseProducts: [
                new AddBaseProduct(
                    productId: 1234,
                    productLabel: 'TestLabel',
                    productPos: 1000,
                    defaultProduct: true,
                    productQuantity: 3,
                ),
            ],
        );

        $this->assertSame(UpdateActionAddBaseProductEnum::UPDATE, $addBaseProducts->getUpdateAction());
        $products = $addBaseProducts->getAddBaseProducts();
        $this->assertCount(1, $products);
        $addBaseProduct = $products[0];
        $this->assertInstanceOf(AddBaseProduct::class, $addBaseProduct);
        $this->assertSame(1234, $addBaseProduct->getProductId());
        $this->assertSame('TestLabel', $addBaseProduct->getProductLabel());
        $this->assertSame(1000, $addBaseProduct->getProductPos());
        $this->assertTrue($addBaseProduct->getDefaultProduct());
        $this->assertSame(3, $addBaseProduct->getProductQuantity());
    }
}
