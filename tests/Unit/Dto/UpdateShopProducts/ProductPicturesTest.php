<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductPicture;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductPictureChild;
use Wundii\AfterbuySdk\Enum\PictureTypEnum;

class ProductPicturesTest extends TestCase
{
    public function testConstructor(): void
    {
        $productPicture = new ProductPicture(
            nr: 1,
            url: 'https://example.com/image1.jpg',
            altText: 'Example Image 1',
            childs: [
                new ProductPictureChild(
                    pictureTypEnum: PictureTypEnum::ZOOM,
                    url: 'https://example.com/image1_child.jpg',
                    altText: 'Example Image 1 Child',
                ),
            ],
        );

        $this->assertSame(1, $productPicture->getNr());
        $this->assertSame('https://example.com/image1.jpg', $productPicture->getUrl());
        $this->assertSame('Example Image 1', $productPicture->getAltText());
        $childs = $productPicture->getChilds();
        $this->assertCount(1, $childs);
        $childPicture = $childs[0];
        $this->assertInstanceOf(ProductPictureChild::class, $childPicture);
        $this->assertSame(PictureTypEnum::ZOOM, $childPicture->getTyp());
        $this->assertSame('https://example.com/image1_child.jpg', $childPicture->getUrl());
        $this->assertSame('Example Image 1 Child', $childPicture->getAltText());
    }

    public function testExceptionOnInvalidNr(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new ProductPicture(
            nr: 0,
            url: 'https://example.com/image1.jpg',
            altText: 'Example Image 1',
            childs: [],
        );

        $this->expectException(\InvalidArgumentException::class);
        new ProductPicture(
            nr: 13,
            url: 'https://example.com/image1.jpg',
            altText: 'Example Image 1',
            childs: [],
        );
    }
}
