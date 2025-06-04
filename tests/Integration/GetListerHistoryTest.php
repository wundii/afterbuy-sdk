<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetListerHistory\ListedItem;
use Wundii\AfterbuySdk\Dto\GetListerHistory\ListedItems;
use Wundii\AfterbuySdk\Dto\GetListerHistory\ListingDetails;
use Wundii\AfterbuySdk\Dto\GetListerHistory\ProductDetails;
use Wundii\AfterbuySdk\Dto\GetListerHistory\ProductDetailsCatalog;
use Wundii\AfterbuySdk\Dto\ResponseError;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EbayCurrencyEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\ListingCountryEnum;
use Wundii\AfterbuySdk\Enum\PlattformEnum;
use Wundii\AfterbuySdk\Enum\SellStatusEnum;
use Wundii\AfterbuySdk\Enum\SiteIdEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Filter\GetListerHistory\AccountId;
use Wundii\AfterbuySdk\Filter\GetListerHistory\Anr;
use Wundii\AfterbuySdk\Filter\GetListerHistory\EndDate;
use Wundii\AfterbuySdk\Filter\GetListerHistory\HistoryId;
use Wundii\AfterbuySdk\Filter\GetListerHistory\ListingType;
use Wundii\AfterbuySdk\Filter\GetListerHistory\Plattform;
use Wundii\AfterbuySdk\Filter\GetListerHistory\RangeAnr;
use Wundii\AfterbuySdk\Filter\GetListerHistory\RangeHistoryId;
use Wundii\AfterbuySdk\Filter\GetListerHistory\SiteId;
use Wundii\AfterbuySdk\Filter\GetListerHistory\StartDate;
use Wundii\AfterbuySdk\Request\GetListerHistoryRequest;
use Wundii\AfterbuySdk\Response\GetListerHistoryResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetListerHistoryTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        $afterbuyGlobal = new AfterbuyGlobal('account', 'partner');
        $afterbuyGlobal->setEndpointEnum(EndpointEnum::SANDBOX);

        return $afterbuyGlobal;
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetListerHistoryRequest();
        $payload = $request->payload($afterbuyGlobal);

        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetListerHistoryRequest(detailLevelEnum: DetailLevelEnum::SECOND);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>2</DetailLevel>', $payload);

        $request = new GetListerHistoryRequest(detailLevelEnum: [DetailLevelEnum::SIXTH]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);
    }

    public function testMaxHistoryItems(): void
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
            new RangeAnr(333, 444),
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

    public function testListerHistorySuccess(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetListerHistorySuccess.xml';

        $request = new GetListerHistoryRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var ListedItems $listedItems */
        $listedItems = $response->getResult();

        $expected = new ListedItems(
            3,
            false,
            [
                new ListedItem(
                    38897689,
                    3041718,
                    1737852,
                    0,
                    listingDetails: new ListingDetails(
                        anr: 9526337680,
                        soldItems: 1,
                        listedQuantity: 1,
                        listingPlattform: 'eBay',
                        listingTitle: 'Afterbuy Testauktion CheckOut Redirect C-O-R 4',
                        listerSubTitle: 'Testauktion 4',
                        listingDuration: 10,
                        listingType: 9,
                        listingDescription: null,
                        listingFee: 1.0,
                        listingCountryEnum: ListingCountryEnum::GERMANY,
                        sellStatusEnum: SellStatusEnum::ERFOLGREICH,
                        startTime: new DateTime('2006-06-01T15:08:48'),
                        endTime: new DateTime('2006-06-11T15:08:48'),
                        ebayCurrencyId: 7,
                        ebayCurrencyEnum: EbayCurrencyEnum::EURO,
                        ebayCategoryId: 31448,
                        ebayCategory2Id: null,
                        ebaySubAccountId: 1001,
                        ebayStartprice: 1.0,
                        ebayBuyItNowPrice: 0.0,
                        ebayPictureUrl: 'http://bilder.afterbuy.de/images/29956/ab-logo.gif',
                        ebayGaleryUrl: 'http://bilder.afterbuy.de/images/29956/ab-logo-icon.gif',
                        ebayRelist: false,
                    ),
                    productDetails: new ProductDetails(
                        name: 'Test Artikel',
                        shortDescription: 'Test',
                        catalogs: [
                            new ProductDetailsCatalog(
                                catalogID: 4,
                                catalogPath: 'test',
                                catalogURL: 'https://www.example.com/test',
                            ),
                        ],
                    ),
                ),
                new ListedItem(
                    38898441,
                    3041716,
                    1915544,
                    0,
                    listingDetails: new ListingDetails(
                        anr: 9526339276,
                        soldItems: 1,
                        listedQuantity: 3,
                        listingPlattform: 'eBay',
                        listingTitle: 'Afterbuy Testauktion CheckOutRedirect C-O-R 3',
                        listerSubTitle: 'Testauktion 3',
                        listingDuration: 10,
                        listingType: 9,
                        listingDescription: null,
                        listingFee: 1.2,
                        listingCountryEnum: ListingCountryEnum::GERMANY,
                        sellStatusEnum: SellStatusEnum::ERFOLGREICH,
                        startTime: new DateTime('2006-06-01T15:13:51'),
                        endTime: new DateTime('2006-06-11T15:13:51'),
                        ebayCurrencyId: 7,
                        ebayCurrencyEnum: EbayCurrencyEnum::EURO,
                        ebayCategoryId: 31448,
                        ebayCategory2Id: null,
                        ebaySubAccountId: 1001,
                        ebayStartprice: 1.0,
                        ebayBuyItNowPrice: 0.0,
                        ebayPictureUrl: 'http://bilder.afterbuy.de/images/29956/ab-logo.gif',
                        ebayGaleryUrl: 'http://bilder.afterbuy.de/images/29956/ab-logo-icon.gif',
                        ebayRelist: false,
                    ),
                ),
                new ListedItem(
                    38899469,
                    3777146,
                    1913970,
                    0,
                    productDetails: new ProductDetails(
                        name: 'Test Artikel 2',
                        shortDescription: 'Test 2',
                        catalogs: [
                            new ProductDetailsCatalog(
                                catalogID: 4,
                                catalogPath: 'test2',
                                catalogURL: 'https://www.example.com/test2',
                            ),
                        ],
                    ),
                ),
            ],
            38897689,
        );

        $this->assertInstanceOf(GetListerHistoryResponse::class, $response);
        $this->assertEquals($expected, $listedItems);
    }

    public function testListerHistoryErrorCode30(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetListerHistoryErrorCode30.xml';

        $request = new GetListerHistoryRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertEquals(CallStatusEnum::ERROR, $response->getCallStatus());
        $this->assertInstanceOf(GetListerHistoryResponse::class, $response);
        $this->assertCount(1, $response->getErrorMessages());
        $this->assertInstanceOf(ResponseError::class, $response->getErrorMessages()[0]);
        $this->assertSame(30, $response->getErrorMessages()[0]->getErrorCode());

        /** @var ListedItems $listedItems */
        $listedItems = $response->getResult();

        $this->assertInstanceOf(ListedItems::class, $listedItems);
        $this->assertCount(0, $listedItems->getListedItems());
    }
}
