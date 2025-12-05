<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetProductDiscounts\ProductDiscount;
use Wundii\AfterbuySdk\Dto\GetProductDiscounts\ProductDiscounts;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Request\GetProductDiscountsRequest;
use Wundii\AfterbuySdk\Response\GetProductDiscountsResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetProductDiscountsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner', EndpointEnum::SANDBOX);
    }

    public function testShopIdAndModDate(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetProductDiscountsRequest(50);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<ShopID>50</ShopID>', $payload);
        $this->assertStringNotContainsString('FromModificationDate', $payload);

        $request = new GetProductDiscountsRequest(60, new DateTime('2025-03-01'));
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<ShopID>60</ShopID>', $payload);
        $this->assertStringContainsString('<FromModificationDate>01.03.2025 00:00:00</FromModificationDate>', $payload);
    }

    public function testProductDiscountsBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetProductDiscountsSuccess.xml';

        $request = new GetProductDiscountsRequest(20);
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var ProductDiscounts $productDiscounts */
        $productDiscounts = $response->getResult();

        $this->assertInstanceOf(GetProductDiscountsResponse::class, $response);
        $this->assertCount(1, $productDiscounts->getProductDiscounts());

        $productDiscount = $productDiscounts->getProductDiscounts()[0];
        $this->assertInstanceOf(ProductDiscount::class, $productDiscount);
        $this->assertSame(1234567, $productDiscount->getProductId());
        $this->assertSame(3, $productDiscount->getControlId());
        $this->assertSame(0.0, $productDiscount->getAmountDiscount());
        $this->assertSame(25.0, $productDiscount->getPercentDiscount());
        $this->assertEquals(new DateTime('2015-12-11 00:00:00'), $productDiscount->getStartDate());
        $this->assertEquals(new DateTime('2025-10-30 23:59:59'), $productDiscount->getEndDate());
        $this->assertEquals(new DateTime('2022-02-01 14:28:03'), $productDiscount->getItemLastUserModificationDate());
        $this->assertSame('UVP', $productDiscount->getPriceType());
        $this->assertSame('Jetzt', $productDiscount->getNewPriceType());
        $this->assertSame(1967589, $productDiscount->getTimeLeftInMinutes());
    }

    public function testCreateConstructor(): void
    {
        $productDiscount = new ProductDiscount(
            1234567,
            3,
            0.0,
            25.0,
            new DateTime('2015-12-11 00:00:00'),
            new DateTime('2025-10-30 23:59:59'),
            new DateTime('2022-02-01 14:28:03'),
            'UVP',
            'Jetzt',
            1967589
        );

        $this->assertSame(1234567, $productDiscount->getProductId());
        $this->assertSame(3, $productDiscount->getControlId());
        $this->assertSame(0.0, $productDiscount->getAmountDiscount());
        $this->assertSame(25.0, $productDiscount->getPercentDiscount());
        $this->assertEquals(new DateTime('2015-12-11 00:00:00'), $productDiscount->getStartDate());
        $this->assertEquals(new DateTime('2025-10-30 23:59:59'), $productDiscount->getEndDate());
        $this->assertEquals(new DateTime('2022-02-01 14:28:03'), $productDiscount->getItemLastUserModificationDate());
        $this->assertSame('UVP', $productDiscount->getPriceType());
        $this->assertSame('Jetzt', $productDiscount->getNewPriceType());
        $this->assertSame(1967589, $productDiscount->getTimeLeftInMinutes());
    }
}
