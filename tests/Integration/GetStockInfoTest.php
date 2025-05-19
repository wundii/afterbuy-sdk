<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\AfterbuyWarning;
use Wundii\AfterbuySdk\Dto\GetStockInfo\Product;
use Wundii\AfterbuySdk\Dto\GetStockInfo\Products;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\ProductFilterEnum;
use Wundii\AfterbuySdk\Filter\GetStockInfo\ProductFilter;
use Wundii\AfterbuySdk\Request\GetStockInfoRequest;
use Wundii\AfterbuySdk\Response\GetStockInfoResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetStockInfoTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetStockInfoRequest(productFilter: [new ProductFilter(ProductFilterEnum::ANR, 1)]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetStockInfoRequest(DetailLevelEnum::FOURTH, [new ProductFilter(ProductFilterEnum::ANR, 1)]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>8</DetailLevel>', $payload);

        $request = new GetStockInfoRequest(DetailLevelEnum::FIFTH, [new ProductFilter(ProductFilterEnum::ANR, 1)]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);
    }

    public function testFilterException(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $this->expectExceptionMessage('ProductFilter is required');
        $request = new GetStockInfoRequest();
        $request->payload($afterbuyGlobal);
    }

    public function testFilter(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetStockInfoRequest(productFilter: [
            new ProductFilter(ProductFilterEnum::ANR, 1),
            new ProductFilter(ProductFilterEnum::PRODUCTID, 2),
            new ProductFilter(ProductFilterEnum::EAN, 'ArNrEan'),
        ]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<Products>', $payload);
        $this->assertStringContainsString('</Products>', $payload);
        $this->assertStringContainsString('<Product><Anr>1</Anr></Product>', $payload);
        $this->assertStringContainsString('<Product><ProductID>2</ProductID></Product>', $payload);
        $this->assertStringContainsString('<Product><EAN>ArNrEan</EAN></Product>', $payload);
    }

    public function testStockInfoBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetStockInfoSuccess.xml';

        $request = new GetStockInfoRequest(productFilter: [new ProductFilter(ProductFilterEnum::ANR, 1)]);
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Products $products */
        $products = $response->getResult();

        $expected = new Products(
            [
                new Product(
                    1737852,
                    'Afterbuy Testauktion CheckOut-Redirect',
                    1243123123,
                    'E3456A277N',
                    0,
                    9997,
                    0,
                    0,
                    true,
                    false,
                    9920,
                    true,
                    100,
                    1,
                ),
                new Product(
                    1908058,
                    'ProduktManager Testartikel',
                    123456789,
                    'E3456A277N',
                    0,
                    99980,
                    0,
                    0,
                    true,
                    true,
                    99980,
                    true,
                    900,
                    9,
                ),
            ]
        );

        $this->assertInstanceOf(GetStockInfoResponse::class, $response);
        $this->assertCount(2, $products->getProducts());
        $this->assertEquals($expected, $products);
    }

    public function testShippingCostErrorCode27(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetStockInfoWarning.xml';

        $request = new GetStockInfoRequest(productFilter: [new ProductFilter(ProductFilterEnum::ANR, 1)]);
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertEquals(CallStatusEnum::WARNING, $response->getCallStatus());
        $this->assertInstanceOf(GetStockInfoResponse::class, $response);
        $this->assertCount(1, $response->getWarningMessages());
        $this->assertInstanceOf(AfterbuyWarning::class, $response->getWarningMessages()[0]);
        $this->assertSame(2, $response->getWarningMessages()[0]->getWarningCode());

        /** @var Products $products */
        $products = $response->getResult();

        $this->assertCount(1, $products->getProducts());
        $this->assertInstanceOf(Product::class, $products->getProducts()[0]);
    }
}
