<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateCatalogs;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalog;

class CatalogTest extends TestCase
{
    public function testCnstructor(): void
    {
        $catalog = new Catalog(
            catalogId: 1,
            catalogName: 'Katalog 1',
            catalogDescription: 'Beschreibung Katalog 1',
            additionalUrl: 'http://www.test.de/katalog1',
            position: 1,
            additionalText: 'KAT1',
            showCatalog: true,
            picture: 'img/katalog1.jpg',
            mouseOverPicture: 'img/katalog1_over.jpg',
            catalog: [
                new Catalog(
                    catalogId: 2,
                    catalogName: 'Unterkatalog 1',
                ),
            ],
        );

        $this->assertSame(1, $catalog->getCatalogId());
        $this->assertSame('Katalog 1', $catalog->getCatalogName());
        $this->assertSame('Beschreibung Katalog 1', $catalog->getCatalogDescription());
        $this->assertSame('http://www.test.de/katalog1', $catalog->getAdditionalUrl());
        $this->assertSame(1, $catalog->getPosition());
        $this->assertSame('KAT1', $catalog->getAdditionalText());
        $this->assertTrue($catalog->getShowCatalog());
        $this->assertSame('img/katalog1.jpg', $catalog->getPicture());
        $this->assertSame('img/katalog1_over.jpg', $catalog->getMouseOverPicture());

        $catalogs = $catalog->getCatalog();
        $this->assertCount(1, $catalogs);
        $this->assertInstanceOf(Catalog::class, $catalogs[0]);
    }

    public function testSetters(): void
    {
        $catalog = new Catalog(1, 'Katalog 1');
        $catalog->setCatalogDescription('Beschreibung Katalog 1');
        $catalog->setAdditionalUrl('http://www.test.de/katalog1');
        $catalog->setPosition(1);
        $catalog->setAdditionalText('KAT1');
        $catalog->setShowCatalog(true);
        $catalog->setPicture('img/katalog1.jpg');
        $catalog->setMouseOverPicture('img/katalog1_over.jpg');
        $catalog->setCatalog([
            new Catalog(
                catalogId: 2,
                catalogName: 'Unterkatalog 1',
            ),
        ]);

        $this->assertSame(1, $catalog->getCatalogId());
        $this->assertSame('Katalog 1', $catalog->getCatalogName());
        $this->assertSame('Beschreibung Katalog 1', $catalog->getCatalogDescription());
        $this->assertSame('http://www.test.de/katalog1', $catalog->getAdditionalUrl());
        $this->assertSame(1, $catalog->getPosition());
        $this->assertSame('KAT1', $catalog->getAdditionalText());
        $this->assertTrue($catalog->getShowCatalog());
        $this->assertSame('img/katalog1.jpg', $catalog->getPicture());
        $this->assertSame('img/katalog1_over.jpg', $catalog->getMouseOverPicture());

        $catalogs = $catalog->getCatalog();
        $this->assertCount(1, $catalogs);
        $this->assertInstanceOf(Catalog::class, $catalogs[0]);
    }
}
