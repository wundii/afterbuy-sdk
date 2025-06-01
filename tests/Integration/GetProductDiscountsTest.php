<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetProductDiscounts\ProductDiscount;
use Wundii\AfterbuySdk\Dto\GetProductDiscounts\ProductDiscounts;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Request\GetProductDiscountsRequest;
use Wundii\AfterbuySdk\Response\GetProductDiscountsResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetProductDiscountsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
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
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var ProductDiscounts $productDiscounts */
        $productDiscounts = $response->getResult();

        $this->assertInstanceOf(GetProductDiscountsResponse::class, $response);
        $this->assertCount(1, $productDiscounts->getProductDiscounts());
        $this->assertInstanceOf(ProductDiscount::class, $productDiscounts->getProductDiscounts()[0]);
    }
}
