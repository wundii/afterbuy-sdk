<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Filter;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Enum\ProductFilterEnum;
use Wundii\AfterbuySdk\Filter\GetStockInfo\ProductFilter;

class GetStockInfoFilterTest extends TestCase
{
    public function testProductFilterWithAnrAndIntValue(): void
    {
        $filter = new ProductFilter(ProductFilterEnum::ANR, 12345);
        $this->assertSame('Anr', $filter->getName());
        $this->assertSame('12345', $filter->getValue());
    }

    public function testProductFilterWithProductIdAndStringValue(): void
    {
        $filter = new ProductFilter(ProductFilterEnum::PRODUCTID, '99');
        $this->assertSame('ProductID', $filter->getName());
        $this->assertSame('99', $filter->getValue());
    }

    public function testProductFilterWithEan(): void
    {
        $filter = new ProductFilter(ProductFilterEnum::EAN, '4012345678901');
        $this->assertSame('EAN', $filter->getName());
        $this->assertSame('4012345678901', $filter->getValue());
    }
}
