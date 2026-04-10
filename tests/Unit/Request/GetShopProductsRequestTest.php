<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Request;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Request\GetShopProductsRequest;

class GetShopProductsRequestTest extends TestCase
{
    public function testMaxShopItemsConstant(): void
    {
        $this->assertSame(250, GetShopProductsRequest::MAX_SHOP_ITEMS);
    }

    public function testCallName(): void
    {
        $request = new GetShopProductsRequest();
        $this->assertSame('GetShopProducts', $request->callName());
    }

    public function testResponseClass(): void
    {
        $request = new GetShopProductsRequest();
        $this->assertSame(\Wundii\AfterbuySdk\Response\GetShopProductsResponse::class, $request->responseClass());
    }

    public function testRequestDtoIsNull(): void
    {
        $request = new GetShopProductsRequest();
        $this->assertNull($request->requestDto());
    }

    public function testQueryIsEmpty(): void
    {
        $request = new GetShopProductsRequest();
        $this->assertSame([], $request->query());
    }
}
