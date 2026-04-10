<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Filter;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Filter\DateFrom;
use Wundii\AfterbuySdk\Filter\DateTo;
use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Filter\LevelFrom;
use Wundii\AfterbuySdk\Filter\LevelTo;
use Wundii\AfterbuySdk\Filter\ProductValue;
use Wundii\AfterbuySdk\Filter\ValueFrom;
use Wundii\AfterbuySdk\Filter\ValueTo;

class FilterValueTest extends TestCase
{
    public function testDateFrom(): void
    {
        $filter = new DateFrom('01.01.2024 00:00:00');
        $this->assertSame('DateFrom', $filter->getKey());
        $this->assertSame('01.01.2024 00:00:00', $filter->getValue());
    }

    public function testDateTo(): void
    {
        $filter = new DateTo('31.12.2024 23:59:59');
        $this->assertSame('DateTo', $filter->getKey());
        $this->assertSame('31.12.2024 23:59:59', $filter->getValue());
    }

    public function testFilterValue(): void
    {
        $filter = new FilterValue('SomeValue');
        $this->assertSame('FilterValue', $filter->getKey());
        $this->assertSame('SomeValue', $filter->getValue());
    }

    public function testLevelFrom(): void
    {
        $filter = new LevelFrom('1');
        $this->assertSame('LevelFrom', $filter->getKey());
        $this->assertSame('1', $filter->getValue());
    }

    public function testLevelTo(): void
    {
        $filter = new LevelTo('5');
        $this->assertSame('LevelTo', $filter->getKey());
        $this->assertSame('5', $filter->getValue());
    }

    public function testValueFrom(): void
    {
        $filter = new ValueFrom('100');
        $this->assertSame('ValueFrom', $filter->getKey());
        $this->assertSame('100', $filter->getValue());
    }

    public function testValueTo(): void
    {
        $filter = new ValueTo('999');
        $this->assertSame('ValueTo', $filter->getKey());
        $this->assertSame('999', $filter->getValue());
    }

    public function testProductValue(): void
    {
        $filter = new ProductValue('MyKey', 'MyValue');
        $this->assertSame('MyKey', $filter->getKey());
        $this->assertSame('MyValue', $filter->getValue());
    }
}
