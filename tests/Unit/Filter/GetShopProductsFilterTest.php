<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Filter;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Enum\DateFilterShopProductsEnum;
use Wundii\AfterbuySdk\Enum\DefaultFilterShopProductsEnum;
use Wundii\AfterbuySdk\Filter\DateFrom;
use Wundii\AfterbuySdk\Filter\DateTo;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Anr;
use Wundii\AfterbuySdk\Filter\GetShopProducts\DateFilter;
use Wundii\AfterbuySdk\Filter\GetShopProducts\DefaultFilter;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Ean;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Level;
use Wundii\AfterbuySdk\Filter\GetShopProducts\ProductId;
use Wundii\AfterbuySdk\Filter\GetShopProducts\RangeAnr;
use Wundii\AfterbuySdk\Filter\GetShopProducts\RangeProductId;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Tag;
use Wundii\AfterbuySdk\Filter\LevelFrom;
use Wundii\AfterbuySdk\Filter\LevelTo;
use Wundii\AfterbuySdk\Filter\ValueFrom;
use Wundii\AfterbuySdk\Filter\ValueTo;

class GetShopProductsFilterTest extends TestCase
{
    public function testAnr(): void
    {
        $filter = new Anr(12345);
        $this->assertSame('Anr', $filter->getFilterName());
        $this->assertEquals([new FilterValue('12345')], $filter->getFilterValues());
    }

    public function testEan(): void
    {
        $filter = new Ean('4012345678901');
        $this->assertSame('Ean', $filter->getFilterName());
        $this->assertEquals([new FilterValue('4012345678901')], $filter->getFilterValues());
    }

    public function testProductId(): void
    {
        $filter = new ProductId(99);
        $this->assertSame('ProductID', $filter->getFilterName());
        $this->assertEquals([new FilterValue('99')], $filter->getFilterValues());
    }

    public function testTag(): void
    {
        $filter = new Tag('sale');
        $this->assertSame('Tag', $filter->getFilterName());
        $this->assertEquals([new FilterValue('sale')], $filter->getFilterValues());
    }

    public function testLevel(): void
    {
        $filter = new Level(1, 3);
        $this->assertSame('Level', $filter->getFilterName());
        $this->assertEquals([new LevelFrom('1'), new LevelTo('3')], $filter->getFilterValues());
    }

    public function testRangeAnr(): void
    {
        $filter = new RangeAnr(100, 200);
        $this->assertSame('RangeAnr', $filter->getFilterName());
        $this->assertEquals([new ValueFrom('100'), new ValueTo('200')], $filter->getFilterValues());
    }

    public function testRangeProductId(): void
    {
        $filter = new RangeProductId(10, 50);
        $this->assertSame('RangeID', $filter->getFilterName());
        $this->assertEquals([new ValueFrom('10'), new ValueTo('50')], $filter->getFilterValues());
    }

    public function testDefaultFilter(): void
    {
        $filter = new DefaultFilter(DefaultFilterShopProductsEnum::ALLSETS);
        $this->assertSame('DefaultFilter', $filter->getFilterName());
        $this->assertEquals([new FilterValue('AllSets')], $filter->getFilterValues());
    }

    public function testDateFilter(): void
    {
        $from = new DateTimeImmutable('2024-01-01 00:00:00');
        $to = new DateTimeImmutable('2024-12-31 23:59:59');
        $filter = new DateFilter($from, $to, DateFilterShopProductsEnum::MOD_DATE);

        $this->assertSame('DateFilter', $filter->getFilterName());
        $this->assertEquals([
            new DateFrom('01.01.2024 00:00:00'),
            new DateTo('31.12.2024 23:59:59'),
            new FilterValue('ModDate'),
        ], $filter->getFilterValues());
    }
}
