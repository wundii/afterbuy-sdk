<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddCatalog;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddCatalogs;
use Wundii\AfterbuySdk\Enum\UpdateActionAddCatalogsEnum;

class AddCatalogsTest extends TestCase
{
    public function testConstructor(): void
    {
        $addCatalogs = new AddCatalogs(
            updateActionAddCatalogsEnum: UpdateActionAddCatalogsEnum::UPDATE,
            addCatalog: [
                new AddCatalog(
                    catalogId: 141556,
                    catalogName: 'MyNEW Katalog',
                    catalogLevel: 1000,
                ),
            ],
        );

        $this->assertSame(UpdateActionAddCatalogsEnum::UPDATE, $addCatalogs->getUpdateActionAddCatalogsEnum());
        $catalogs = $addCatalogs->getAddCatalog();
        $this->assertCount(1, $catalogs);
        $addCatalog = $catalogs[0];
        $this->assertInstanceOf(AddCatalog::class, $addCatalog);
        $this->assertSame(141556, $addCatalog->getCatalogId());
        $this->assertSame('MyNEW Katalog', $addCatalog->getCatalogName());
        $this->assertSame(1000, $addCatalog->getCatalogLevel());
    }
}
