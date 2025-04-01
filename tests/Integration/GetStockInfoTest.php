<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\AfterbuyWarning;
use AfterbuySdk\Dto\GetStockInfo\Product;
use AfterbuySdk\Dto\GetStockInfo\Products;
use AfterbuySdk\Enum\CallStatusEnum;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\ProductFilterEnum;
use AfterbuySdk\Filter\GetStockInfo\ProductFilter;
use AfterbuySdk\Request\GetStockInfoRequest;
use AfterbuySdk\Response\GetStockInfoResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

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
