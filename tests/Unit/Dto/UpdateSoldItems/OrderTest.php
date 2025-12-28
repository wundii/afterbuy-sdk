<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateSoldItems;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\Attribute;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\BuyerInfo;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\Order;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\ParcelLabel;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\PaymentInfo;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\ShippingAddress;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\ShippingInfo;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\VorgangsInfo;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;

class OrderTest extends TestCase
{
    public function testConstructor(): void
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
    }
}
