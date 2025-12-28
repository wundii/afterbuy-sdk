<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\Attribute;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\BuyerInfo;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\Order;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\ParcelLabel;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\PaymentInfo;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\ShippingAddress;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\ShippingInfo;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\VorgangsInfo;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Interface\RequestDtoInterface;
use Wundii\AfterbuySdk\Request\UpdateSoldItemsRequest;
use Wundii\AfterbuySdk\Response\UpdateSoldItemsResponse;
use Wundii\AfterbuySdk\Tests\DomFormatter;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class UpdateSoldItemsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner', EndpointEnum::SANDBOX);
    }

    public function validate(RequestDtoInterface $afterbuyAppendContent): array
    {
        $errors = [];
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $validator = $afterbuy->getValidator();

        $constraintViolationList = $validator->validate($afterbuyAppendContent);

        foreach ($constraintViolationList as $error) {
            $errors[] = sprintf('%s: %s', $error->getPropertyPath(), $error->getMessage());
        }

        return $errors;
    }

    public function testValidateEmptyOrderRequirements(): void
    {
        $this->expectExceptionMessage('At least one of orderId, itemId or userDefindedFlag must be set');

        new Order();
    }

    public function testValidateMaxOrders(): void
    {
        $orders = array_map(fn ($i) => new Order($i + 1), range(0, 150));
        $this->assertCount(151, $orders);

        $request = new UpdateSoldItemsRequest(
            $orders,
        );

        $errors = $this->validate($request->requestDto());
        $expected = [
            'orders: This collection should contain 150 elements or less.',
        ];

        $this->assertEquals($expected, $errors);
    }

    public function testValidateUniqueParcelLabel(): void
    {
        $request = new UpdateSoldItemsRequest(
            [
                new Order(
                    12345600,
                    shippingInfo: new ShippingInfo(
                        parcelLabels: [
                            new ParcelLabel(12345600, 1, '0123DHL-1'),
                            new ParcelLabel(12345600, 5, '0123DHL-5'),
                            new ParcelLabel(12345601, 4, '0123DHL-4'),
                            new ParcelLabel(12345601, 5, '0123DHL-6'),
                            new ParcelLabel(12345602, 1, '0123DHL-2'),
                            new ParcelLabel(12345603, 2, '0123DHL-2'),
                            new ParcelLabel(12345603, 3, '0123DHL-3'),
                        ]
                    ),
                ),
            ]
        );

        $errors = $this->validate($request->requestDto());
        $expected = [
            'orders[0].shippingInfo.parcelLabels: Parcel label number [0123DHL-2, 0123DHL-6] must be unique in order',
        ];

        $this->assertEquals($expected, $errors);
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
                            new ParcelLabel(12345600, 1, '0123DHL-1', null, 1, 1.2),
                            new ParcelLabel(12345600, 5, '0123DHL-5', null, 1, 2.2),
                            new ParcelLabel(12345601, 4, '0123DHL-4', null, 1, 2.1),
                            new ParcelLabel(12345601, 5, '0123DHL-5', null, 1, 3.44),
                            new ParcelLabel(12345602, 1, '0123DHL-1', null, 1, 44.3),
                            new ParcelLabel(12345603, 2, '0123DHL-2', null, 1, 1.0),
                            new ParcelLabel(12345603, 3, '0123DHL-3', null, 1, 2.0),
                        ]
                    ),
                ),
            ]
        );
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($file);

        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));
    }

    public function testUpdateSoldItemsResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateSoldItemsSuccess.xml';

        $request = new UpdateSoldItemsRequest(
            [
                new Order(1),
            ]
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertInstanceOf(UpdateSoldItemsResponse::class, $response);
        $this->assertNull($response->getResult());
    }
}
