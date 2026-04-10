<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Filter;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Enum\DateFilterSoldItemsEnum;
use Wundii\AfterbuySdk\Enum\DefaultFilterSoldItemsEnum;
use Wundii\AfterbuySdk\Enum\PlattformEnum;
use Wundii\AfterbuySdk\Filter\DateFrom;
use Wundii\AfterbuySdk\Filter\DateTo;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AfterbuyUserEmail;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AfterbuyUserId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AlternativeItemNumber1;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AlternativeItemNumber2;
use Wundii\AfterbuySdk\Filter\GetSoldItems\DateFilter;
use Wundii\AfterbuySdk\Filter\GetSoldItems\DefaultFilter;
use Wundii\AfterbuySdk\Filter\GetSoldItems\InvoiceNumber;
use Wundii\AfterbuySdk\Filter\GetSoldItems\OrderId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\Plattform;
use Wundii\AfterbuySdk\Filter\GetSoldItems\RangeOrderId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\ShopId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\Tag;
use Wundii\AfterbuySdk\Filter\GetSoldItems\UserDefinedFlag;
use Wundii\AfterbuySdk\Filter\ValueFrom;
use Wundii\AfterbuySdk\Filter\ValueTo;

class GetSoldItemsFilterTest extends TestCase
{
    public function testAfterbuyUserEmail(): void
    {
        $filter = new AfterbuyUserEmail('test@example.com');
        $this->assertSame('AfterbuyUserEmail', $filter->getFilterName());
        $this->assertEquals([new FilterValue('test@example.com')], $filter->getFilterValues());
    }

    public function testAfterbuyUserId(): void
    {
        $filter = new AfterbuyUserId(42);
        $this->assertSame('AfterbuyUserID', $filter->getFilterName());
        $this->assertEquals([new FilterValue('42')], $filter->getFilterValues());
    }

    public function testAlternativeItemNumber1(): void
    {
        $filter = new AlternativeItemNumber1('ALT-001');
        $this->assertSame('AlternativeItemNumber1', $filter->getFilterName());
        $this->assertEquals([new FilterValue('ALT-001')], $filter->getFilterValues());
    }

    public function testAlternativeItemNumber2(): void
    {
        $filter = new AlternativeItemNumber2('ALT-002');
        $this->assertSame('AlternativeItemNumber2', $filter->getFilterName());
        $this->assertEquals([new FilterValue('ALT-002')], $filter->getFilterValues());
    }

    public function testInvoiceNumber(): void
    {
        $filter = new InvoiceNumber(12345);
        $this->assertSame('InvoiceNumber', $filter->getFilterName());
        $this->assertEquals([new FilterValue('12345')], $filter->getFilterValues());
    }

    public function testOrderId(): void
    {
        $filter = new OrderId(99);
        $this->assertSame('OrderID', $filter->getFilterName());
        $this->assertEquals([new FilterValue('99')], $filter->getFilterValues());
    }

    public function testShopId(): void
    {
        $filter = new ShopId(7);
        $this->assertSame('ShopId', $filter->getFilterName());
        $this->assertEquals([new FilterValue('7')], $filter->getFilterValues());
    }

    public function testTag(): void
    {
        $filter = new Tag('express');
        $this->assertSame('Tag', $filter->getFilterName());
        $this->assertEquals([new FilterValue('express')], $filter->getFilterValues());
    }

    public function testUserDefinedFlag(): void
    {
        $filter = new UserDefinedFlag(3);
        $this->assertSame('UserDefinedFlag', $filter->getFilterName());
        $this->assertEquals([new FilterValue('3')], $filter->getFilterValues());
    }

    public function testRangeOrderId(): void
    {
        $filter = new RangeOrderId(100, 200);
        $this->assertSame('RangeID', $filter->getFilterName());
        $this->assertEquals([new ValueFrom('100'), new ValueTo('200')], $filter->getFilterValues());
    }

    public function testDefaultFilter(): void
    {
        $filter = new DefaultFilter(DefaultFilterSoldItemsEnum::NEWAUCTIONS);
        $this->assertSame('DefaultFilter', $filter->getFilterName());
        $this->assertEquals([new FilterValue('NewAuctions')], $filter->getFilterValues());
    }

    public function testPlattform(): void
    {
        $filter = new Plattform(PlattformEnum::EBAY);
        $this->assertSame('Plattform', $filter->getFilterName());
        $this->assertEquals([new FilterValue('eBay')], $filter->getFilterValues());
    }

    public function testDateFilter(): void
    {
        $from = new DateTimeImmutable('2024-06-01 00:00:00');
        $to = new DateTimeImmutable('2024-06-30 23:59:59');
        $filter = new DateFilter($from, $to, DateFilterSoldItemsEnum::PAY_DATE);

        $this->assertSame('DateFilter', $filter->getFilterName());
        $this->assertEquals([
            new DateFrom('01.06.2024 00:00:00'),
            new DateTo('30.06.2024 23:59:59'),
            new FilterValue('PayDate'),
        ], $filter->getFilterValues());
    }
}
