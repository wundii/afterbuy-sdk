<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Filter;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Enum\PlattformEnum;
use Wundii\AfterbuySdk\Enum\SiteIdEnum;
use Wundii\AfterbuySdk\Filter\DateFrom;
use Wundii\AfterbuySdk\Filter\DateTo;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Filter\GetListerHistory\AccountId;
use Wundii\AfterbuySdk\Filter\GetListerHistory\Anr;
use Wundii\AfterbuySdk\Filter\GetListerHistory\EndDate;
use Wundii\AfterbuySdk\Filter\GetListerHistory\HistoryId;
use Wundii\AfterbuySdk\Filter\GetListerHistory\ListingType;
use Wundii\AfterbuySdk\Filter\GetListerHistory\Plattform;
use Wundii\AfterbuySdk\Filter\GetListerHistory\RangeAnr;
use Wundii\AfterbuySdk\Filter\GetListerHistory\RangeHistoryId;
use Wundii\AfterbuySdk\Filter\GetListerHistory\SiteId;
use Wundii\AfterbuySdk\Filter\GetListerHistory\StartDate;
use Wundii\AfterbuySdk\Filter\ValueFrom;
use Wundii\AfterbuySdk\Filter\ValueTo;

class GetListerHistoryFilterTest extends TestCase
{
    public function testAccountId(): void
    {
        $filter = new AccountId(1001);
        $this->assertSame('AccountID', $filter->getFilterName());
        $this->assertEquals([new FilterValue('1001')], $filter->getFilterValues());
    }

    public function testAnr(): void
    {
        $filter = new Anr(555);
        $this->assertSame('Anr', $filter->getFilterName());
        $this->assertEquals([new FilterValue('555')], $filter->getFilterValues());
    }

    public function testHistoryId(): void
    {
        $filter = new HistoryId(77);
        $this->assertSame('HistoryID', $filter->getFilterName());
        $this->assertEquals([new FilterValue('77')], $filter->getFilterValues());
    }

    public function testListingType(): void
    {
        $filter = new ListingType(1);
        $this->assertSame('ListingType', $filter->getFilterName());
        $this->assertEquals([new FilterValue('1')], $filter->getFilterValues());
    }

    public function testPlattform(): void
    {
        $filter = new Plattform(PlattformEnum::HOOD);
        $this->assertSame('Plattform', $filter->getFilterName());
        $this->assertEquals([new FilterValue('Hood')], $filter->getFilterValues());
    }

    public function testSiteId(): void
    {
        $filter = new SiteId(SiteIdEnum::EBAY_GERMANY);
        $this->assertSame('Plattform', $filter->getFilterName());
        $this->assertEquals([new FilterValue('77')], $filter->getFilterValues());
    }

    public function testRangeAnr(): void
    {
        $filter = new RangeAnr(10, 99);
        $this->assertSame('RangeAnr', $filter->getFilterName());
        $this->assertEquals([new ValueFrom('10'), new ValueTo('99')], $filter->getFilterValues());
    }

    public function testRangeHistoryId(): void
    {
        $filter = new RangeHistoryId(200, 300);
        $this->assertSame('RangeID', $filter->getFilterName());
        $this->assertEquals([new ValueFrom('200'), new ValueTo('300')], $filter->getFilterValues());
    }

    public function testStartDate(): void
    {
        $from = new DateTimeImmutable('2024-01-01 00:00:00');
        $to = new DateTimeImmutable('2024-01-31 23:59:59');
        $filter = new StartDate($from, $to);

        $this->assertSame('StartDate', $filter->getFilterName());
        $this->assertEquals([
            new DateFrom('01.01.2024 00:00:00'),
            new DateTo('31.01.2024 23:59:59'),
        ], $filter->getFilterValues());
    }

    public function testEndDate(): void
    {
        $from = new DateTimeImmutable('2024-03-01 00:00:00');
        $to = new DateTimeImmutable('2024-03-31 23:59:59');
        $filter = new EndDate($from, $to);

        $this->assertSame('EndDate', $filter->getFilterName());
        $this->assertEquals([
            new DateFrom('01.03.2024 00:00:00'),
            new DateTo('31.03.2024 23:59:59'),
        ], $filter->getFilterValues());
    }
}
