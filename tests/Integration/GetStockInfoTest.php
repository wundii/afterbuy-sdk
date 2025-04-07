<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
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

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testStockInfoBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetStockInfoSuccess.xml';

        $request = new GetStockInfoRequest(productFilter: [new ProductFilter(ProductFilterEnum::ANR, 1)]);
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Products $products */
        $products = $response->getResult();

        $this->assertInstanceOf(GetStockInfoResponse::class, $response);
        $this->assertCount(2, $products->getProducts());
        $this->assertInstanceOf(Product::class, $products->getProducts()[0]);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
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

        $this->assertInstanceOf(GetStockInfoResponse::class, $response);
        $this->assertCount(1, $products->getProducts());
        $this->assertInstanceOf(Product::class, $products->getProducts()[0]);
    }
}
