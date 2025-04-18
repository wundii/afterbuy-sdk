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
use Wundii\AfterbuySdk\Dto\GetSoldItems\Order;
use Wundii\AfterbuySdk\Dto\GetSoldItems\Orders;
use Wundii\AfterbuySdk\Enum\DefaultFilterSoldItemsEnum;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\OrderDirectionEnum;
use Wundii\AfterbuySdk\Enum\PlattformEnum;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AfterbuyUserEmail;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AfterbuyUserId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AlternativeItemNumber1;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AlternativeItemNumber2;
use Wundii\AfterbuySdk\Filter\GetSoldItems\DefaultFilter;
use Wundii\AfterbuySdk\Filter\GetSoldItems\InvoiceNumber;
use Wundii\AfterbuySdk\Filter\GetSoldItems\OrderId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\Plattform;
use Wundii\AfterbuySdk\Filter\GetSoldItems\RangeOrderId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\ShopId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\Tag;
use Wundii\AfterbuySdk\Filter\GetSoldItems\UserDefinedFlag;
use Wundii\AfterbuySdk\Request\GetSoldItemsRequest;
use Wundii\AfterbuySdk\Response\GetSoldItemsResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetSoldItemsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetSoldItemsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetSoldItemsRequest(DetailLevelEnum::SIXTH);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>32</DetailLevel>', $payload);

        $request = new GetSoldItemsRequest(DetailLevelEnum::SEVENTH);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);
    }

    public function testRequestAllItems(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetSoldItemsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('RequestAllItems', $payload);

        $request = new GetSoldItemsRequest(requestAllItems: false);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<RequestAllItems>0</RequestAllItems>', $payload);

        $request = new GetSoldItemsRequest(requestAllItems: true);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<RequestAllItems>1</RequestAllItems>', $payload);
    }

    public function tesMaxSoldItems(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetSoldItemsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxSoldItems>250</MaxSoldItems>', $payload);

        $request = new GetSoldItemsRequest(maxSoldItems: 50);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxSoldItems>50</MaxSoldItems>', $payload);

        $request = new GetSoldItemsRequest(maxSoldItems: 300);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxSoldItems>250</MaxSoldItems>', $payload);
    }

    public function testOrderDirection(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetSoldItemsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<OrderDirection>0</OrderDirection>', $payload);

        $request = new GetSoldItemsRequest(orderDirectionEnum: OrderDirectionEnum::ASC);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<OrderDirection>0</OrderDirection>', $payload);

        $request = new GetSoldItemsRequest(orderDirectionEnum: OrderDirectionEnum::DESC);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<OrderDirection>1</OrderDirection>', $payload);
    }

    public function testReturnHiddenItems(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetSoldItemsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<ReturnHiddenItems>0</ReturnHiddenItems>', $payload);

        $request = new GetSoldItemsRequest(returnHiddenItems: false);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<ReturnHiddenItems>0</ReturnHiddenItems>', $payload);

        $request = new GetSoldItemsRequest(returnHiddenItems: true);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<ReturnHiddenItems>1</ReturnHiddenItems>', $payload);
    }

    public function testFilter(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetSoldItemsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('<DataFilter>', $payload);

        $request = new GetSoldItemsRequest(filter: [
            new OrderId(123),
            new Plattform(PlattformEnum::HOOD),
            new RangeOrderId(111, 222),
            new DefaultFilter(DefaultFilterSoldItemsEnum::NEWAUCTIONS),
            new AfterbuyUserId(10),
            new UserDefinedFlag(11),
            new AfterbuyUserEmail('example@example.com'),
            new ShopId(20),
            new Tag('afterbuy'),
            new InvoiceNumber(234),
            new AlternativeItemNumber1('30'),
            new AlternativeItemNumber2('31'),
        ]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DataFilter>', $payload);
        $this->assertStringContainsString('</DataFilter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>OrderID</FilterName><FilterValues><FilterValue>123</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Plattform</FilterName><FilterValues><FilterValue>Hood</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>RangeID</FilterName><FilterValues><ValueFrom>111</ValueFrom><ValueTo>222</ValueTo></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>DefaultFilter</FilterName><FilterValues><FilterValue>NewAuctions</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>AfterbuyUserID</FilterName><FilterValues><FilterValue>10</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>UserDefinedFlag</FilterName><FilterValues><FilterValue>11</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>AfterbuyUserEmail</FilterName><FilterValues><FilterValue>example@example.com</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>ShopId</FilterName><FilterValues><FilterValue>20</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Tag</FilterName><FilterValues><FilterValue>afterbuy</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>InvoiceNumber</FilterName><FilterValues><FilterValue>234</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>AlternativeItemNumber1</FilterName><FilterValues><FilterValue>30</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>AlternativeItemNumber2</FilterName><FilterValues><FilterValue>31</FilterValue></FilterValues></Filter>', $payload);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testSoldItemsBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetSoldItemsSuccess.xml';

        $request = new GetSoldItemsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Orders $orders */
        $orders = $response->getResult();

        $this->assertInstanceOf(GetSoldItemsResponse::class, $response);
        $this->assertSame(true, $orders->hasMoreItems());
        $this->assertCount(1, $orders->getOrders());
        $this->assertInstanceOf(Order::class, $orders->getOrders()[0]);
    }
}
