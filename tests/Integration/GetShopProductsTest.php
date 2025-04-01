<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetShopProducts\Product;
use AfterbuySdk\Dto\GetShopProducts\Products;
use AfterbuySdk\Enum\DateFilterEnum;
use AfterbuySdk\Enum\DefaultFilterShopProductsEnum;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Extends\DateTime;
use AfterbuySdk\Filter\GetShopProducts\Anr;
use AfterbuySdk\Filter\GetShopProducts\DateFilter;
use AfterbuySdk\Filter\GetShopProducts\DefaultFilter;
use AfterbuySdk\Filter\GetShopProducts\Ean;
use AfterbuySdk\Filter\GetShopProducts\Level;
use AfterbuySdk\Filter\GetShopProducts\ProductId;
use AfterbuySdk\Filter\GetShopProducts\RangeAnr;
use AfterbuySdk\Filter\GetShopProducts\RangeProductId;
use AfterbuySdk\Filter\GetShopProducts\Tag;
use AfterbuySdk\Request\GetShopProductsRequest;
use AfterbuySdk\Response\GetShopProductsResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetShopProductsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetShopProductsRequest(DetailLevelEnum::EIGHTH);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>128</DetailLevel>', $payload);

        $request = new GetShopProductsRequest(DetailLevelEnum::SIXTH);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);
    }

    public function testMaxShopItems(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxShopItems>100</MaxShopItems>', $payload);

        $request = new GetShopProductsRequest(maxShopItems: 50);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxShopItems>50</MaxShopItems>', $payload);

        $request = new GetShopProductsRequest(maxShopItems: 300);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxShopItems>250</MaxShopItems>', $payload);
    }

    public function testSuppressBaseProductRelatedData(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<SuppressBaseProductRelatedData>0</SuppressBaseProductRelatedData>', $payload);

        $request = new GetShopProductsRequest(suppressBaseProductRelatedData: true);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<SuppressBaseProductRelatedData>1</SuppressBaseProductRelatedData>', $payload);
    }

    public function testPaginationEnabled(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('PaginationEnabled', $payload);

        $request = new GetShopProductsRequest(paginationEnabled: true);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<PaginationEnabled>1</PaginationEnabled>', $payload);
    }

    public function testPageNumber(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('PageNumber', $payload);

        $request = new GetShopProductsRequest(pageNumber: 12);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<PageNumber>12</PageNumber>', $payload);
    }

    public function testReturnShop20Container(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('ReturnShop20Container', $payload);

        $request = new GetShopProductsRequest(returnShop20Container: true);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<ReturnShop20Container>1</ReturnShop20Container>', $payload);
    }

    public function testFilter(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('<DataFilter>', $payload);

        $request = new GetShopProductsRequest(filter: [
            new ProductId(1),
            new Anr(2),
            new Ean('3'),
            new Tag('item'),
            new DefaultFilter(DefaultFilterShopProductsEnum::NOT_ALLSETS),
            new Level(0, 2),
            new RangeProductId(12, 34),
            new RangeAnr(56, 78),
            new DateFilter(new DateTime('2025-03-01'), new DateTime('2025-03-31'), DateFilterEnum::MOD_DATE),
        ]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DataFilter>', $payload);
        $this->assertStringContainsString('</DataFilter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>ProductID</FilterName><FilterValues><FilterValue>1</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Anr</FilterName><FilterValues><FilterValue>2</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Ean</FilterName><FilterValues><FilterValue>3</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Tag</FilterName><FilterValues><FilterValue>item</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>DefaultFilter</FilterName><FilterValues><FilterValue>Not_AllSets</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Level</FilterName><FilterValues><LevelFrom>0</LevelFrom><LevelTo>2</LevelTo></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>RangeID</FilterName><FilterValues><ValueFrom>12</ValueFrom><ValueTo>34</ValueTo></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>RangeAnr</FilterName><FilterValues><ValueFrom>56</ValueFrom><ValueTo>78</ValueTo></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>DateFilter</FilterName><FilterValues><DateFrom>01.03.2025 00:00:00</DateFrom><DateTo>31.03.2025 00:00:00</DateTo><FilterValue>ModDate</FilterValue></FilterValues></Filter>', $payload);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testShopProductsBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShopProductsSuccess.xml';

        $request = new GetShopProductsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Products $products */
        $products = $response->getResult();

        $this->assertInstanceOf(GetShopProductsResponse::class, $response);
        $this->assertCount(1, $products->getProducts());
        $this->assertSame(true, $products->hasMoreProducts());
        $this->assertSame(1010101, $products->getLastProductId());
        $this->assertInstanceOf(Product::class, $products->getProducts()[0]);
    }
}
