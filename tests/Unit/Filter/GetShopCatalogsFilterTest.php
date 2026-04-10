<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Filter;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\CatalogId;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\Level;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\RangeCatalogId;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\RangeLevel;
use Wundii\AfterbuySdk\Filter\ValueFrom;
use Wundii\AfterbuySdk\Filter\ValueTo;

class GetShopCatalogsFilterTest extends TestCase
{
    public function testCatalogId(): void
    {
        $filter = new CatalogId(42);
        $this->assertSame('CatalogID', $filter->getFilterName());
        $this->assertEquals([new FilterValue('42')], $filter->getFilterValues());
    }

    public function testLevel(): void
    {
        $filter = new Level(2);
        $this->assertSame('Level', $filter->getFilterName());
        $this->assertEquals([new FilterValue('2')], $filter->getFilterValues());
    }

    public function testRangeCatalogId(): void
    {
        $filter = new RangeCatalogId(10, 20);
        $this->assertSame('RangeID', $filter->getFilterName());
        $this->assertEquals([new ValueFrom('10'), new ValueTo('20')], $filter->getFilterValues());
    }

    public function testRangeLevel(): void
    {
        $filter = new RangeLevel(1, 5);
        $this->assertSame('RangeLevel', $filter->getFilterName());
        $this->assertEquals([new ValueFrom('1'), new ValueTo('5')], $filter->getFilterValues());
    }
}
