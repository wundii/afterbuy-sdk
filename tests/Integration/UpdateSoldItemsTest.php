<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use DateTimeImmutable;
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

    public function testOrder(): void
    {
        $order = new Order(orderId: 1);

        $date = new DateTimeImmutable();

        $attribute = new Attribute(
            'name',
            'value',
        );
        $shippingAddress = new ShippingAddress(
            true,
            'FirstName',
            'LastName',
            'Company',
            'Street',
            'Address2',
            'Address3',
            'Address4',
            'ZipCode',
            'City',
            'Germany',
            CountryIsoEnum::GERMANY,
        );
        $buyerInfo = new BuyerInfo($shippingAddress);
        $paymentInfo = new PaymentInfo(
            'PaymentMethod',
            $date,
            'TransactionId',
            10.0,
            2.0,
            true,
        );
        $parcelLabel = new ParcelLabel(
            1,
            1,
            'ParcelLabelNumber',
            'ReturnLabelNumber',
            3,
            5.0,
        );
        $shippingInfo = new ShippingInfo(
            'ShippingMethod',
            'ShippingReturnMethod',
            'ShippingGroup',
            4.5,
            $date,
            'DeliveryService',
            2.0,
            true,
            [
                $parcelLabel,
            ],
        );
        $vorgangsInfo = new VorgangsInfo(
            'VorgangsInfo1',
            'VorgangsInfo2',
            'VorgangsInfo3',
        );

        $order->setAdditionalInfo('info');
        $this->assertSame('info', $order->getAdditionalInfo());

        $order->setAttributes([$attribute]);
        $this->assertSame([$attribute], $order->getAttributes());
        $attribute = $order->getAttributes()[0];
        $this->assertSame('name', $attribute->getName());
        $this->assertSame('value', $attribute->getValue());

        $order->setBuyerInfo($buyerInfo);
        $this->assertSame($buyerInfo, $order->getBuyerInfo());
        $buyerInfo = $order->getBuyerInfo();
        $this->assertSame($shippingAddress, $buyerInfo->getShippingAddress());
        $shippingAddress = $buyerInfo->getShippingAddress();
        $this->assertTrue($shippingAddress->getUseShippingAddress());
        $this->assertSame('FirstName', $shippingAddress->getFirstName());
        $this->assertSame('LastName', $shippingAddress->getLastName());
        $this->assertSame('Company', $shippingAddress->getCompany());
        $this->assertSame('Street', $shippingAddress->getStreet());
        $this->assertSame('Address2', $shippingAddress->getStreet2());
        $this->assertSame('Address3', $shippingAddress->getStateOrProvince());
        $this->assertSame('Address4', $shippingAddress->getPhone());
        $this->assertSame('ZipCode', $shippingAddress->getPostalCode());
        $this->assertSame('City', $shippingAddress->getCity());
        $this->assertSame('Germany', $shippingAddress->getCountry());
        $this->assertSame(CountryIsoEnum::GERMANY, $shippingAddress->getCountryIso());

        $order->setFeedbackDate($date);
        $this->assertSame($date, $order->getFeedbackDate());

        $order->setHideOrder(true);
        $this->assertTrue($order->getHideOrder());

        $order->setInvoiceDate($date);
        $this->assertSame($date, $order->getInvoiceDate());

        $order->setInvoiceMemo('memo');
        $this->assertSame('memo', $order->getInvoiceMemo());

        $order->setInvoiceNumber(42);
        $this->assertSame(42, $order->getInvoiceNumber());

        $order->setItemId(99);
        $this->assertSame(99, $order->getItemId());

        $order->setMailDate($date);
        $this->assertSame($date, $order->getMailDate());

        $order->setOrderExported(false);
        $this->assertFalse($order->getOrderExported());

        $order->setOrderId(123);
        $this->assertSame(123, $order->getOrderId());

        $order->setOrderMemo('order memo');
        $this->assertSame('order memo', $order->getOrderMemo());

        $order->setPaymentInfo($paymentInfo);
        $this->assertSame($paymentInfo, $order->getPaymentInfo());
        $paymentInfo = $order->getPaymentInfo();
        $this->assertSame('PaymentMethod', $paymentInfo->getPaymentMethod());
        $this->assertSame($date, $paymentInfo->getPaymentDate());
        $this->assertSame('TransactionId', $paymentInfo->getPaymentTransactionId());
        $this->assertSame(10.0, $paymentInfo->getAlreadyPaid());
        $this->assertSame(2.0, $paymentInfo->getPaymentAdditionalCost());
        $this->assertTrue($paymentInfo->getSendPaymentMail());

        $order->setProductId(77);
        $this->assertSame(77, $order->getProductId());

        $order->setReminder1Date($date);
        $this->assertSame($date, $order->getReminder1Date());

        $order->setReminder2Date($date);
        $this->assertSame($date, $order->getReminder2Date());

        $order->setReminderMailDate($date);
        $this->assertSame($date, $order->getReminderMailDate());

        $order->setShippingInfo($shippingInfo);
        $this->assertSame($shippingInfo, $order->getShippingInfo());
        $shippingInfo = $order->getShippingInfo();
        $this->assertSame('ShippingMethod', $shippingInfo->getShippingMethod());
        $this->assertSame('ShippingReturnMethod', $shippingInfo->getShippingReturnMethod());
        $this->assertSame('ShippingGroup', $shippingInfo->getShippingGroup());
        $this->assertSame(4.5, $shippingInfo->getShippingCost());
        $this->assertSame($date, $shippingInfo->getDeliveryDate());
        $this->assertSame('DeliveryService', $shippingInfo->getDeliveryService());
        $this->assertSame(2.0, $shippingInfo->getEbayShippingCost());
        $this->assertTrue($shippingInfo->getSendShippingMail());
        $this->assertSame([$parcelLabel], $shippingInfo->getParcelLabels());
        $parcelLabel = $shippingInfo->getParcelLabels()[0];
        $this->assertSame(1, $parcelLabel->getItemId());
        $this->assertSame(1, $parcelLabel->getPackageNumber());
        $this->assertSame('ParcelLabelNumber', $parcelLabel->getParcelLabelNumber());
        $this->assertSame('ReturnLabelNumber', $parcelLabel->getReturnLabelNumber());
        $this->assertSame(3, $parcelLabel->getPackageQuantity());
        $this->assertSame(5.0, $parcelLabel->getPackageWeight());

        $order->setTags(['a', 'b']);
        $this->assertSame(['a', 'b'], $order->getTags());

        $order->setUserComment('comment');
        $this->assertSame('comment', $order->getUserComment());

        $order->setUserDefindedFlag(5);
        $this->assertSame(5, $order->getUserDefindedFlag());

        $order->setVorgangsInfo($vorgangsInfo);
        $this->assertSame($vorgangsInfo, $order->getVorgangsInfo());
        $vorgangsInfo = $order->getVorgangsInfo();
        $this->assertSame('VorgangsInfo1', $vorgangsInfo->getVorgangsInfo1());
        $this->assertSame('VorgangsInfo2', $vorgangsInfo->getVorgangsInfo2());
        $this->assertSame('VorgangsInfo3', $vorgangsInfo->getVorgangsInfo3());

        $order->setXmlDate($date);
        $this->assertSame($date, $order->getXmlDate());

        $errors = $this->validate($order);
        $this->assertEmpty($errors);
    }
}
