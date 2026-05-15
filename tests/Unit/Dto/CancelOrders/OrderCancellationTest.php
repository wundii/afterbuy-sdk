<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\CancelOrders;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\CancelOrders\OrderCancellation;
use Wundii\AfterbuySdk\Enum\StockBookingEnum;

class OrderCancellationTest extends TestCase
{
    public function testConstructor(): void
    {
        $orderCancellation = new OrderCancellation(1234567);

        $this->assertSame(1234567, $orderCancellation->getOrderId());
        $this->assertNull($orderCancellation->getStockBooking());
        $this->assertNull($orderCancellation->getHideOrder());
        $this->assertNull($orderCancellation->getMarkId());
    }

    public function testConstructorWithAllParameters(): void
    {
        $orderCancellation = new OrderCancellation(
            1234567,
            StockBookingEnum::AUCTION,
            true,
            5,
        );

        $this->assertSame(1234567, $orderCancellation->getOrderId());
        $this->assertSame(StockBookingEnum::AUCTION, $orderCancellation->getStockBooking());
        $this->assertTrue($orderCancellation->getHideOrder());
        $this->assertSame(5, $orderCancellation->getMarkId());
    }

    public function testSetters(): void
    {
        $orderCancellation = new OrderCancellation(1);

        $orderCancellation->setOrderId(9999);
        $this->assertSame(9999, $orderCancellation->getOrderId());

        $orderCancellation->setStockBooking(StockBookingEnum::SHOP);
        $this->assertSame(StockBookingEnum::SHOP, $orderCancellation->getStockBooking());

        $orderCancellation->setHideOrder(true);
        $this->assertTrue($orderCancellation->getHideOrder());

        $orderCancellation->setMarkId(3);
        $this->assertSame(3, $orderCancellation->getMarkId());

        $orderCancellation->setStockBooking(null);
        $this->assertNull($orderCancellation->getStockBooking());

        $orderCancellation->setHideOrder(null);
        $this->assertNull($orderCancellation->getHideOrder());

        $orderCancellation->setMarkId(null);
        $this->assertNull($orderCancellation->getMarkId());
    }
}
