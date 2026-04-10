<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Enum;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Enum\DateFilterShopProductsEnum;
use Wundii\AfterbuySdk\Enum\DateFilterSoldItemsEnum;
use Wundii\AfterbuySdk\Enum\DefaultFilterShopProductsEnum;
use Wundii\AfterbuySdk\Enum\DefaultFilterSoldItemsEnum;
use Wundii\AfterbuySdk\Enum\ProductFilterEnum;

class FilterEnumsTest extends TestCase
{
    public function testDateFilterShopProductsEnumValues(): void
    {
        $this->assertSame('ModDate', DateFilterShopProductsEnum::MOD_DATE->value);
        $this->assertSame('LastSale', DateFilterShopProductsEnum::LAST_SALE->value);
        $this->assertSame('LastStockChange', DateFilterShopProductsEnum::LAST_STOCK_CHANGE->value);
    }

    public function testDateFilterSoldItemsEnumValues(): void
    {
        $this->assertSame('AuctionEndDate', DateFilterSoldItemsEnum::AUCTION_END_DATE->value);
        $this->assertSame('PayDate', DateFilterSoldItemsEnum::PAY_DATE->value);
        $this->assertSame('ShippingDate', DateFilterSoldItemsEnum::SHIPPING_DATE->value);
        $this->assertSame('ModDate', DateFilterSoldItemsEnum::MOD_DATE->value);
    }

    public function testDefaultFilterShopProductsEnumValues(): void
    {
        $this->assertSame('AllSets', DefaultFilterShopProductsEnum::ALLSETS->value);
        $this->assertSame('VariationsSets', DefaultFilterShopProductsEnum::VARIATIONSSETS->value);
        $this->assertSame('Not_AllSets', DefaultFilterShopProductsEnum::NOT_ALLSETS->value);
    }

    public function testDefaultFilterSoldItemsEnumValues(): void
    {
        $this->assertSame('NewAuctions', DefaultFilterSoldItemsEnum::NEWAUCTIONS->value);
        $this->assertSame('PaidAuctions', DefaultFilterSoldItemsEnum::PAIDAUCTIONS->value);
        $this->assertSame('Not_NewAuctions', DefaultFilterSoldItemsEnum::NOT_NEWAUCTIONS->value);
        $this->assertSame('ReadyToShip', DefaultFilterSoldItemsEnum::READYTOSHIP->value);
    }

    public function testProductFilterEnumValues(): void
    {
        $this->assertSame('Anr', ProductFilterEnum::ANR->value);
        $this->assertSame('ProductID', ProductFilterEnum::PRODUCTID->value);
        $this->assertSame('EAN', ProductFilterEnum::EAN->value);
    }
}
