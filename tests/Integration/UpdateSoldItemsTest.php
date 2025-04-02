<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\UpdateSoldItems\Attribute;
use AfterbuySdk\Dto\UpdateSoldItems\BuyerInfo;
use AfterbuySdk\Dto\UpdateSoldItems\Order;
use AfterbuySdk\Dto\UpdateSoldItems\ParcelLabel;
use AfterbuySdk\Dto\UpdateSoldItems\PaymentInfo;
use AfterbuySdk\Dto\UpdateSoldItems\ShippingAddress;
use AfterbuySdk\Dto\UpdateSoldItems\ShippingInfo;
use AfterbuySdk\Dto\UpdateSoldItems\VorgangsInfo;
use AfterbuySdk\Enum\CountryIsoEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Extends\DateTime;
use AfterbuySdk\Request\UpdateSoldItemsRequest;
use AfterbuySdk\Response\UpdateSoldItemsResponse;
use AfterbuySdk\Tests\DomFormatter;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class UpdateSoldItemsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testValidateEmptyOrderRequirements(): void
    {
        $this->expectExceptionMessage('At least one of orderId, itemId or userDefindedFlag must be set');

        new Order();
    }

    public function testValidateMaxOrders(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $orders = array_map(fn ($i) => new Order($i + 1), range(0, 150));
        $this->assertCount(151, $orders);

        $request = new UpdateSoldItemsRequest(
            $orders,
        );

        $this->expectExceptionMessage('Orders can not contain more than 150 catalogs');
        $request->payload($afterbuyGlobal);
    }

    public function testUpdateSoldItemsRequestBasic(): void
    {
        $file = __DIR__ . '/RequestFiles/UpdateSoldItemsBasic.xml';
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new UpdateSoldItemsRequest(
            [
                new Order(
                    42771483,
                    42771537,
                    null,
                    null,
                    'ZusatzInfo',
                    new DateTime('2006-05-25 03:01:03'),
                    new DateTime('2006-05-25 07:01:07'),
                    'Userkommentar',
                    'Userkommentar',
                    'Rechnungsvermerk',
                    true,
                    new DateTime('2006-05-25 10:11:12'),
                    99,
                    false,
                    new DateTime('2006-05-24 08:09:10'),
                    new DateTime('2006-05-23 08:09:10'),
                    null,
                    new DateTime('2006-05-25 08:09:10'),
                    new BuyerInfo(new ShippingAddress(
                        null,
                        'Interface',
                        'Afterbuy',
                        'Via Online',
                        'Str 23',
                        null,
                        null,
                        null,
                        '47829',
                        'London',
                        CountryIsoEnum::UNITED_KINGDOM_ALTERNATIVE->value,
                        null,
                    )),
                    new PaymentInfo(
                        'Überweisung',
                        new DateTime('2006-05-25 01:03:05'),
                        null,
                        22.3,
                        2.55,
                        null,
                    ),
                    new ShippingInfo(
                        'DHL',
                        null,
                        'standard',
                        2.55,
                        new DateTime('2006-05-25 05:06:07'),
                        null,
                        0.99,
                        null,
                        [],
                    ),
                    new VorgangsInfo(
                        'VorgangsInfo1',
                        'VorgangsInfo2',
                        'VorgangsInfo3',
                    ),
                    [
                        'tag1',
                        'tag2',
                    ],
                    [
                        new Attribute('attr1', 'val1'),
                        new Attribute('attr2', 'val2'),
                        new Attribute('attr3', 'val3'),
                    ],
                ),
            ]
        );
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($file);

        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));
    }

    public function testUpdateSoldItemsRequestParcelLabel(): void
    {
        $file = __DIR__ . '/RequestFiles/UpdateSoldItemsParcelLabel.xml';
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new UpdateSoldItemsRequest(
            [
                new Order(
                    12345600,
                    shippingInfo: new ShippingInfo(
                        parcelLabels: [
                            new ParcelLabel(12345600, 1, '0123DHL-1'),
                            new ParcelLabel(12345600, 5, '0123DHL-5'),
                            new ParcelLabel(12345601, 4, '0123DHL-4'),
                            new ParcelLabel(12345601, 5, '0123DHL-5'),
                            new ParcelLabel(12345602, 1, '0123DHL-1'),
                            new ParcelLabel(12345603, 2, '0123DHL-2'),
                            new ParcelLabel(12345603, 3, '0123DHL-3'),
                        ]
                    ),
                ),
            ]
        );
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($file);

        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testUpdateSoldItemsResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateSoldItemsSuccess.xml';

        $request = new UpdateSoldItemsRequest(
            [
                new Order(1),
            ]
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertInstanceOf(UpdateSoldItemsResponse::class, $response);
        $this->assertNull($response->getResult());
    }
}
