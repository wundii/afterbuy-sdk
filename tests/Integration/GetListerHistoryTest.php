<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyError;
use AfterbuySdk\Dto\AfterbuyErrorList;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetListerHistory\ListedItem;
use AfterbuySdk\Dto\GetListerHistory\ListedItems;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\PlattformEnum;
use AfterbuySdk\Enum\SiteIdEnum;
use AfterbuySdk\Extends\DateTime;
use AfterbuySdk\Filter\GetListerHistory\AccountId;
use AfterbuySdk\Filter\GetListerHistory\Anr;
use AfterbuySdk\Filter\GetListerHistory\EndDate;
use AfterbuySdk\Filter\GetListerHistory\HistoryId;
use AfterbuySdk\Filter\GetListerHistory\ListingType;
use AfterbuySdk\Filter\GetListerHistory\Plattform;
use AfterbuySdk\Filter\GetListerHistory\RangeAn;
use AfterbuySdk\Filter\GetListerHistory\RangeHistoryId;
use AfterbuySdk\Filter\GetListerHistory\SiteId;
use AfterbuySdk\Filter\GetListerHistory\StartDate;
use AfterbuySdk\Request\GetListerHistoryRequest;
use AfterbuySdk\Response\AfterbuyErrorResponse;
use AfterbuySdk\Response\GetListerHistoryResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetListerHistoryTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetListerHistoryRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetListerHistoryRequest(DetailLevelEnum::SECOND);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>2</DetailLevel>', $payload);

        $request = new GetListerHistoryRequest(DetailLevelEnum::SIXTH);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);
    }

    public function testMaxCatalogs(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetListerHistoryRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxHistoryItems>100</MaxHistoryItems>', $payload);

        $request = new GetListerHistoryRequest(maxHistoryItems: 50);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxHistoryItems>50</MaxHistoryItems>', $payload);
    }

    public function testFilter(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetListerHistoryRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('<DataFilter>', $payload);

        $request = new GetListerHistoryRequest(filter: [
            new Anr(321),
            new HistoryId(123),
            new AccountId(1),
            new ListingType(0),
            new Plattform(PlattformEnum::HOOD),
            new SiteId(SiteIdEnum::EBAY_GERMANY),
            new RangeAn(333, 444),
            new RangeHistoryId(111, 222),
            new StartDate(new DateTime('2025-03-01'), new DateTime('2025-03-31')),
            new EndDate(new DateTime('2025-03-01'), new DateTime('2025-03-31')),
        ]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DataFilter>', $payload);
        $this->assertStringContainsString('</DataFilter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Anr</FilterName><FilterValues><FilterValue>321</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>HistoryID</FilterName><FilterValues><FilterValue>123</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>AccountID</FilterName><FilterValues><FilterValue>1</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>ListingType</FilterName><FilterValues><FilterValue>0</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Plattform</FilterName><FilterValues><FilterValue>Hood</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>RangeAnr</FilterName><FilterValues><ValueFrom>333</ValueFrom><ValueTo>444</ValueTo></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>RangeID</FilterName><FilterValues><ValueFrom>111</ValueFrom><ValueTo>222</ValueTo></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>StartDate</FilterName><FilterValues><DateFrom>01.03.2025 00:00:00</DateFrom><DateTo>31.03.2025 00:00:00</DateTo></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>EndDate</FilterName><FilterValues><DateFrom>01.03.2025 00:00:00</DateFrom><DateTo>31.03.2025 00:00:00</DateTo></FilterValues></Filter>', $payload);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testShopCatalogsSuccess(): void
    {
        $file = __DIR__ . '/Files/GetListerHistorySuccess.xml';

        $request = new GetListerHistoryRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var ListedItems $listedItems */
        $listedItems = $response->getResponse();

        $this->assertInstanceOf(GetListerHistoryResponse::class, $response);
        $this->assertCount(3, $listedItems->getListedItems());
        $this->assertInstanceOf(ListedItem::class, $listedItems->getListedItems()[0]);
        $this->assertSame(38897689, $listedItems->getLastHistoryId());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testShopCatalogsErrorCode30(): void
    {
        $file = __DIR__ . '/Files/GetListerHistoryErrorCode30.xml';

        $request = new GetListerHistoryRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var AfterbuyErrorList $afterbuyErrorList */
        $afterbuyErrorList = $response->getResponse();

        $this->assertInstanceOf(AfterbuyErrorResponse::class, $response);
        $this->assertCount(1, $afterbuyErrorList->getErrorList());
        $this->assertInstanceOf(AfterbuyError::class, $afterbuyErrorList->getErrorList()[0]);
        $this->assertSame(30, $afterbuyErrorList->getErrorList()[0]->getErrorCode());
    }
}
