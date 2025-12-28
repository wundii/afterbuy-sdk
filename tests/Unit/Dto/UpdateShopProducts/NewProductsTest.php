<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\NewProduct;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\NewProducts;

class NewProductsTest extends TestCase
{
    public function testConstructor(): void
    {
        $newProducts = new NewProducts(
            newProducts: [
                new NewProduct(
                    productId: 12345,
                    productIdRequested: 0,
                    userProductId: '12346ABCD',
                    anrRequested: 0,
                    eanRequested: 'EANREQUESTED',
                    anr: 123456789,
                    ean: 'EAN',
                ),
            ],
        );

        $this->assertCount(1, $newProducts->getNewProducts());
        $product = $newProducts->getNewProducts()[0];
        $this->assertInstanceOf(NewProduct::class, $product);
        $this->assertSame(12345, $product->getProductId());
        $this->assertSame(0, $product->getProductIdRequested());
        $this->assertSame('12346ABCD', $product->getUserProductId());
        $this->assertSame(0, $product->getAnrRequested());
        $this->assertSame('EANREQUESTED', $product->getEanRequested());
        $this->assertSame(123456789, $product->getAnr());
        $this->assertSame('EAN', $product->getEan());
    }

    public function testSetters(): void
    {
        $newProducts = new NewProducts();

        $newProduct = new NewProduct();
        $newProduct->setProductId(54321);
        $newProduct->setProductIdRequested(1);
        $newProduct->setUserProductId('54321DCBA');
        $newProduct->setAnrRequested(1);
        $newProduct->setEanRequested('EANREQ2');
        $newProduct->setAnr(987654321);
        $newProduct->setEan('EAN2');

        $newProducts->setNewProducts([$newProduct]);

        $this->assertCount(1, $newProducts->getNewProducts());
        $product = $newProducts->getNewProducts()[0];
        $this->assertInstanceOf(NewProduct::class, $product);
        $this->assertSame(54321, $product->getProductId());
        $this->assertSame(1, $product->getProductIdRequested());
        $this->assertSame('54321DCBA', $product->getUserProductId());
        $this->assertSame(1, $product->getAnrRequested());
        $this->assertSame('EANREQ2', $product->getEanRequested());
        $this->assertSame(987654321, $product->getAnr());
        $this->assertSame('EAN2', $product->getEan());
    }
}
