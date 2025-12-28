<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetSoldItems\BaseProductData;
use Wundii\AfterbuySdk\Dto\GetSoldItems\BillingAddress;
use Wundii\AfterbuySdk\Dto\GetSoldItems\BuyerInfo;
use Wundii\AfterbuySdk\Dto\GetSoldItems\ChildProduct;
use Wundii\AfterbuySdk\Dto\GetSoldItems\ItemOriginalCurrency;
use Wundii\AfterbuySdk\Dto\GetSoldItems\Order;
use Wundii\AfterbuySdk\Dto\GetSoldItems\OrderOriginalCurrency;
use Wundii\AfterbuySdk\Dto\GetSoldItems\Orders;
use Wundii\AfterbuySdk\Dto\GetSoldItems\ParcelLabel;
use Wundii\AfterbuySdk\Dto\GetSoldItems\PaymentData;
use Wundii\AfterbuySdk\Dto\GetSoldItems\PaymentInfo;
use Wundii\AfterbuySdk\Dto\GetSoldItems\ShippingAddress;
use Wundii\AfterbuySdk\Dto\GetSoldItems\ShippingInfo;
use Wundii\AfterbuySdk\Dto\GetSoldItems\ShopProductDetails;
use Wundii\AfterbuySdk\Dto\GetSoldItems\SoldItem;
use Wundii\AfterbuySdk\Dto\GetSoldItems\SoldItems;
use Wundii\AfterbuySdk\Enum\BaseProductTypeEnum;
use Wundii\AfterbuySdk\Enum\Core\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Enum\DefaultFilterSoldItemsEnum;
use Wundii\AfterbuySdk\Enum\InternalItemTypeEnum;
use Wundii\AfterbuySdk\Enum\ItemPlatFormNameEnum;
use Wundii\AfterbuySdk\Enum\ItemPriceCodeEnum;
use Wundii\AfterbuySdk\Enum\OrderDirectionEnum;
use Wundii\AfterbuySdk\Enum\PaymentFunctionEnum;
use Wundii\AfterbuySdk\Enum\PaymentIdEnum;
use Wundii\AfterbuySdk\Enum\PlattformEnum;
use Wundii\AfterbuySdk\Enum\TaxCollectedByEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
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
        return new AfterbuyGlobal('account', 'partner', EndpointEnum::SANDBOX);
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetSoldItemsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetSoldItemsRequest(detailLevelEnum: DetailLevelEnum::SIXTH);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>32</DetailLevel>', $payload);

        $request = new GetSoldItemsRequest(detailLevelEnum: [DetailLevelEnum::SEVENTH]);
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

    public function testSoldItemsBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetSoldItemsSuccess.xml';

        $request = new GetSoldItemsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Orders $orders */
        $orders = $response->getResult();

        $expected = new Order(
            invoiceNumber: 10075,
            orderId: 43151135,
            anr: 12345,
            orderDate: new DateTime('2023-09-11 12:22:07'),
            paymentInfo: new PaymentInfo(
                paymentIdEnum: PaymentIdEnum::INVOICE,
                paymentMethod: 'eBay Managed Payment',
                paymentFunctionEnum: PaymentFunctionEnum::OTHERS,
                paymentTransactionId: '1234567890',
                paymentStatus: 'Completed',
                paymentDate: new DateTime('2023-09-11 12:22:14'),
                alreadyPaid: 112.3,
                fullAmount: 112.3,
                invoiceDate: new DateTime('2023-09-11'),
                paymentData: new PaymentData(
                    bankCode: '12345678',
                    accountHolder: 'Max Mustermann',
                    bankName: 'Musterbank',
                    accountNumber: '1234567890',
                    iban: 'DE12345678901234567890',
                    bic: 'MUSTERBICXXX',
                    referenceNumber: 'Rechnungsnummer 10075',
                ),
            ),
            buyerInfo: new BuyerInfo(
                new BillingAddress(
                    afterbuyUserId: 123456,
                    afterbuyUserIdAlt: 12345,
                    userIdPlattform: 'afterbuy1_testaccount',
                    firstName: 'Max',
                    lastName: 'Mustermann',
                    title: 'Dr',
                    company: 'Test GmbH',
                    street: 'Musterstrasse 8',
                    street2: 'Hinterhof',
                    postalCode: '12345',
                    city: 'Musterhausen',
                    country: 'D',
                    countryIsoEnum: CountryIsoEnum::GERMANY,
                    phone: '+0123456789',
                    fax: '+0123456790',
                    mail: 'info@example.com',
                    isMerchant: true,
                    taxIdNumber: '1234567890',
                ),
                new ShippingAddress(
                    firstName: 'Max',
                    lastName: 'Mustermann',
                    company: 'Test GmbH',
                    street: 'Musterstrasse 8',
                    street2: 'Hinterhof',
                    postalCode: '12345',
                    city: 'Musterhausen',
                    phone: '+0123456789',
                    country: 'D',
                    countryIsoEnum: CountryIsoEnum::GERMANY,
                    taxIdNumber: '1234567890',
                ),
            ),
            soldItems: new SoldItems(
                [
                    new SoldItem(
                        itemId: 123456,
                        anr: 12345678,
                        platformSpecificOrderId: '01-2345-6789',
                        ebayTransactionId: 1234567890,
                        eBayPlusTransaction: true,
                        internalItemTypeEnum: InternalItemTypeEnum::BUY_IT_NOW,
                        itemTitle: 'Blumenvase',
                        itemQuantity: 1,
                        itemPrice: 112.3,
                        itemEndDate: new DateTime('2023-09-11 12:22:07'),
                        taxRate: 19.0,
                        taxCollectedByEnum: TaxCollectedByEnum::DEFAULT,
                        itemWeight: 9.88,
                        itemXmlDate: new DateTime('2023-09-11T14:06:53'),
                        itemModDate: new DateTime('2025-05-15 14:34:05'),
                        itemPlatFormNameEnum: ItemPlatFormNameEnum::EBAY,
                        itemLink: 'https://www.example.com/item/123456',
                        ebayFeedbackCompleted: true,
                        ebayFeedbackReceived: true,
                        ebayFeedbackCommentType: 'Positive',
                        itemOriginalCurrency: new ItemOriginalCurrency(
                            itemPrice: 112.3,
                            itemPriceCodeEnum: ItemPriceCodeEnum::EURO,
                            itemShipping: 0.0,
                        ),
                        shopProductDetails: new ShopProductDetails(
                            productId: 1234567890,
                            anr: 1234567890,
                            ean: '3210123456789',
                            unitOfQuantity: 'Stk',
                            basepriceFactor: 1.0,
                            baseProductData: new BaseProductData(
                                baseProductTypeEnum: BaseProductTypeEnum::PRODUCT_SET,
                                childProduct: [
                                    new ChildProduct(
                                        productId: 1234567891,
                                        productAnr: 1234567891,
                                        productEan: '3210123456790',
                                        productName: 'Blumenvase',
                                        productQuantity: 1,
                                        productVat: 19.0,
                                        productWeight: 4.94,
                                        productUnitPrice: 54.45,
                                        stockLocation1: 'sl1',
                                        stockLocation2: 'sl2',
                                        stockLocation3: 'sl3',
                                    ),
                                    new ChildProduct(
                                        productId: 1234567892,
                                        productAnr: 1234567892,
                                        productEan: '3210123456791',
                                        productName: 'Untersetzer',
                                        productQuantity: 1,
                                        productVat: 19.0,
                                        productWeight: 0.54,
                                        productUnitPrice: 55.73,
                                        stockLocation1: 'sl1',
                                        stockLocation2: 'sl2',
                                        stockLocation3: 'sl3',
                                    ),
                                ],
                            ),
                            stockLocation1: 'sl1',
                            stockLocation2: 'sl2',
                            stockLocation3: 'sl3',
                        ),
                    ),
                ],
                itemsInOrder: 1,
            ),
            shippingInfo: new ShippingInfo(
                shippingMethod: 'Paketdienst',
                shippingCost: 0.0,
                shippingAdditionalCost: 0,
                shippingTotalCost: 0.0,
                shippingTaxRate: 19.00,
                deliveryDate: new DateTime('2024-03-14'),
                parcelLabels: [
                    new ParcelLabel(
                        itemId: 43151135,
                        packageNumber: 1,
                        parcelLabelNumber: '00340434464181524067',
                        returnLabelNumber: '99353347120585',
                    ),
                ],
            ),
            orderOriginalCurrency: new OrderOriginalCurrency(
                ebayShippingAmount: 0.0,
                shippingAmount: 0.0,
                paymentSurcharge: 0.0,
                paymentSurchargePerCent: 0.0,
                invoiceAmount: 112.3,
                exchangeRate: 0,
                payedAmount: 112.3,
            ),
            feedbackDate: new DateTime('2023-09-11 12:22:14'),
            feedbackLink: 'https://www.example.com',
            ebayAccount: 'afterbuy',
            userComment: 'User Comment',
            additionalInfo: '0123456789',
            trackingLink: 'https://www.example.com/track?code=1234567890',
            memo: 'Memo',
            isCheckoutConfirmedByCustomer: 0,
            orderIDAlt: null,
            containsEbayPlusTransaction: true,
        );

        $this->assertInstanceOf(GetSoldItemsResponse::class, $response);
        $this->assertSame(true, $orders->hasMoreItems());
        $this->assertSame(1, $orders->getOrdersCount());
        $this->assertSame(43151135, $orders->getLastOrderId());
        $this->assertSame(4, $orders->getItemsCount());
        $this->assertSame(true, $orders->hasMoreItems());
        $this->assertCount(1, $orders->getOrders());

        $order = $orders->getOrders()[0];
        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals($expected, $order);

        $this->assertSame(10075, $order->getInvoiceNumber());
        $this->assertSame(43151135, $order->getOrderId());
        $this->assertSame(12345, $order->getAnr());
        $this->assertInstanceOf(DateTime::class, $order->getOrderDate());
        $this->assertInstanceOf(DateTime::class, $order->getFeedbackDate());
        $this->assertSame('https://www.example.com', $order->getFeedbackLink());
        $this->assertSame('afterbuy', $order->getEbayAccount());
        $this->assertSame(null, $order->getAmazonAccount());
        $this->assertSame('User Comment', $order->getUserComment());
        $this->assertSame('0123456789', $order->getAdditionalInfo());
        $this->assertSame(null, $order->getAlternativeItemNumber1());
        $this->assertSame('https://www.example.com/track?code=1234567890', $order->getTrackingLink());
        $this->assertSame('Memo', $order->getMemo());
        $this->assertSame(null, $order->getInvoiceMemo());
        $this->assertSame(0, $order->getIsCheckoutConfirmedByCustomer());
        $this->assertSame(null, $order->getOrderIDAlt());
        $this->assertSame(true, $order->isContainsEbayPlusTransaction());

        $paymentInfo = $order->getPaymentInfo();
        $this->assertInstanceOf(PaymentInfo::class, $paymentInfo);
        $this->assertSame(PaymentIdEnum::INVOICE, $paymentInfo->getPaymentId());
        $this->assertSame(112.3, $paymentInfo->getAlreadyPaid());
        $this->assertSame(112.3, $paymentInfo->getFullAmount());
        $this->assertInstanceOf(DateTime::class, $paymentInfo->getInvoiceDate());
        $this->assertSame('eBay Managed Payment', $paymentInfo->getPaymentMethod());
        $this->assertSame(PaymentFunctionEnum::OTHERS, $paymentInfo->getPaymentFunction());
        $this->assertSame('1234567890', $paymentInfo->getPaymentTransactionId());
        $this->assertSame('Completed', $paymentInfo->getPaymentStatus());
        $this->assertInstanceOf(DateTime::class, $paymentInfo->getPaymentDate());
        $this->assertSame(null, $paymentInfo->getPaymentInstruction());
        $this->assertSame([], $paymentInfo->getPayoutIds());
        $paymentData = $paymentInfo->getPaymentData();
        $this->assertInstanceOf(PaymentData::class, $paymentData);
        $this->assertSame('12345678', $paymentData->getBankCode());
        $this->assertSame('Max Mustermann', $paymentData->getAccountHolder());
        $this->assertSame('Musterbank', $paymentData->getBankName());
        $this->assertSame('1234567890', $paymentData->getAccountNumber());
        $this->assertSame('DE12345678901234567890', $paymentData->getIban());
        $this->assertSame('MUSTERBICXXX', $paymentData->getBic());
        $this->assertSame('Rechnungsnummer 10075', $paymentData->getReferenceNumber());

        $buyerInfo = $order->getBuyerInfo();
        $this->assertInstanceOf(BuyerInfo::class, $buyerInfo);
        $billingAddress = $buyerInfo->getBillingAddress();
        $this->assertSame(123456, $billingAddress->getAfterbuyUserId());
        $this->assertSame(12345, $billingAddress->getAfterbuyUserIdAlt());
        $this->assertSame('afterbuy1_testaccount', $billingAddress->getUserIdPlattform());
        $this->assertSame('Max', $billingAddress->getFirstName());
        $this->assertSame('Mustermann', $billingAddress->getLastName());
        $this->assertSame('Dr', $billingAddress->getTitle());
        $this->assertSame('Test GmbH', $billingAddress->getCompany());
        $this->assertSame('Musterstrasse 8', $billingAddress->getStreet());
        $this->assertSame('Hinterhof', $billingAddress->getStreet2());
        $this->assertSame('12345', $billingAddress->getPostalCode());
        $this->assertSame('Musterhausen', $billingAddress->getCity());
        $this->assertSame('D', $billingAddress->getCountry());
        $this->assertSame(CountryIsoEnum::GERMANY, $billingAddress->getCountryIso());
        $this->assertSame('+0123456789', $billingAddress->getPhone());
        $this->assertSame('+0123456790', $billingAddress->getFax());
        $this->assertSame('info@example.com', $billingAddress->getMail());
        $this->assertSame(true, $billingAddress->isMerchant());
        $this->assertSame('1234567890', $billingAddress->getTaxIdNumber());

        $shippingAddress = $buyerInfo->getShippingAddress();
        $this->assertSame('Max', $shippingAddress->getFirstName());
        $this->assertSame('Mustermann', $shippingAddress->getLastName());
        $this->assertSame('Test GmbH', $shippingAddress->getCompany());
        $this->assertSame('Musterstrasse 8', $shippingAddress->getStreet());
        $this->assertSame('Hinterhof', $shippingAddress->getStreet2());
        $this->assertSame('12345', $shippingAddress->getPostalCode());
        $this->assertSame('Musterhausen', $shippingAddress->getCity());
        $this->assertSame('+0123456789', $shippingAddress->getPhone());
        $this->assertSame('D', $shippingAddress->getCountry());
        $this->assertSame(CountryIsoEnum::GERMANY, $shippingAddress->getCountryIso());
        $this->assertSame('1234567890', $shippingAddress->getTaxIdNumber());

        $soldItems = $order->getSoldItems();
        $this->assertInstanceOf(SoldItems::class, $soldItems);
        $this->assertCount(1, $soldItems->getSoldItem());
        $this->assertSame(1, $soldItems->getItemsInOrder());
        $item = $soldItems->getSoldItem()[0];
        $this->assertInstanceOf(SoldItem::class, $item);
        $this->assertSame(123456, $item->getItemId());
        $this->assertSame(12345678, $item->getAnr());
        $this->assertSame('01-2345-6789', $item->getPlatformSpecificOrderId());
        $this->assertSame(1234567890, $item->getEbayTransactionId());
        $this->assertSame(true, $item->isEBayPlusTransaction());
        $this->assertSame(InternalItemTypeEnum::BUY_IT_NOW, $item->getInternalItemTypeEnum());
        $this->assertSame('Blumenvase', $item->getItemTitle());
        $this->assertSame(1, $item->getItemQuantity());
        $this->assertSame(112.3, $item->getItemPrice());
        $this->assertInstanceOf(DateTime::class, $item->getItemEndDate());
        $this->assertSame(19.0, $item->getTaxRate());
        $this->assertSame(TaxCollectedByEnum::DEFAULT, $item->getTaxCollectedBy());
        $this->assertSame(9.88, $item->getItemWeight());
        $this->assertInstanceOf(DateTime::class, $item->getItemXmlDate());
        $this->assertInstanceOf(DateTime::class, $item->getItemModDate());
        $this->assertSame(ItemPlatFormNameEnum::EBAY, $item->getItemPlatFormName());
        $this->assertSame('https://www.example.com/item/123456', $item->getItemLink());
        $this->assertSame(true, $item->getEbayFeedbackCompleted());
        $this->assertSame(true, $item->getEbayFeedbackReceived());
        $this->assertSame('Positive', $item->getEbayFeedbackCommentType());
        $itemOriginalCurrency = $item->getItemOriginalCurrency();
        $this->assertInstanceOf(ItemOriginalCurrency::class, $itemOriginalCurrency);
        $this->assertSame(112.3, $itemOriginalCurrency->getItemPrice());
        $this->assertSame(ItemPriceCodeEnum::EURO, $itemOriginalCurrency->getItemPriceCode());
        $this->assertSame(0.0, $itemOriginalCurrency->getItemShipping());
        $shopProductDetails = $item->getShopProductDetails();
        $this->assertInstanceOf(ShopProductDetails::class, $shopProductDetails);
        $this->assertSame(1234567890, $shopProductDetails->getProductId());
        $this->assertSame(1234567890, $shopProductDetails->getAnr());
        $this->assertSame('3210123456789', $shopProductDetails->getEan());
        $this->assertSame('Stk', $shopProductDetails->getUnitOfQuantity());
        $this->assertSame(1.0, $shopProductDetails->getBasepriceFactor());
        $baseProductData = $shopProductDetails->getBaseProductData();
        $this->assertInstanceOf(BaseProductData::class, $baseProductData);
        $this->assertSame(BaseProductTypeEnum::PRODUCT_SET, $baseProductData->getBaseProductType());
        $this->assertCount(2, $baseProductData->getChildProduct());
        $childProduct1 = $baseProductData->getChildProduct()[0];
        $this->assertInstanceOf(ChildProduct::class, $childProduct1);
        $this->assertSame(1234567891, $childProduct1->getProductId());
        $this->assertSame(1234567891, $childProduct1->getProductAnr());
        $this->assertSame('3210123456790', $childProduct1->getProductEan());
        $this->assertSame('Blumenvase', $childProduct1->getProductName());
        $this->assertSame(1, $childProduct1->getProductQuantity());
        $this->assertSame(19.0, $childProduct1->getProductVat());
        $this->assertSame(4.94, $childProduct1->getProductWeight());
        $this->assertSame(54.45, $childProduct1->getProductUnitPrice());
        $this->assertSame('sl1', $childProduct1->getStockLocation1());
        $this->assertSame('sl2', $childProduct1->getStockLocation2());
        $this->assertSame('sl3', $childProduct1->getStockLocation3());
        $childProduct2 = $baseProductData->getChildProduct()[1];
        $this->assertInstanceOf(ChildProduct::class, $childProduct2);
        $this->assertSame(1234567892, $childProduct2->getProductId());
        $this->assertSame(1234567892, $childProduct2->getProductAnr());
        $this->assertSame('3210123456791', $childProduct2->getProductEan());
        $this->assertSame('Untersetzer', $childProduct2->getProductName());
        $this->assertSame(1, $childProduct2->getProductQuantity());
        $this->assertSame(19.0, $childProduct2->getProductVat());
        $this->assertSame(0.54, $childProduct2->getProductWeight());
        $this->assertSame(55.73, $childProduct2->getProductUnitPrice());
        $this->assertSame('sl1', $childProduct2->getStockLocation1());
        $this->assertSame('sl2', $childProduct2->getStockLocation2());
        $this->assertSame('sl3', $childProduct2->getStockLocation3());
        $this->assertSame('sl1', $shopProductDetails->getStockLocation1());
        $this->assertSame('sl2', $shopProductDetails->getStockLocation2());
        $this->assertSame('sl3', $shopProductDetails->getStockLocation3());

        $shippingInfo = $order->getShippingInfo();
        $this->assertInstanceOf(ShippingInfo::class, $shippingInfo);
        $this->assertSame('Paketdienst', $shippingInfo->getShippingMethod());
        $this->assertSame(null, $shippingInfo->getShippingReturnMethod());
        $this->assertSame(0.0, $shippingInfo->getShippingCost());
        $this->assertSame(0.0, $shippingInfo->getShippingAdditionalCost());
        $this->assertSame(0.0, $shippingInfo->getShippingTotalCost());
        $this->assertSame(19.00, $shippingInfo->getShippingTaxRate());
        $this->assertInstanceOf(DateTime::class, $shippingInfo->getDeliveryDate());
        $this->assertCount(1, $shippingInfo->getParcelLabels());
        $parcelLabel = $shippingInfo->getParcelLabels()[0];
        $this->assertInstanceOf(ParcelLabel::class, $parcelLabel);
        $this->assertSame(43151135, $parcelLabel->getItemId());
        $this->assertSame(1, $parcelLabel->getPackageNumber());
        $this->assertSame('00340434464181524067', $parcelLabel->getParcelLabelNumber());
        $this->assertSame('99353347120585', $parcelLabel->getReturnLabelNumber());

        $orderOriginalCurrency = $order->getOrderOriginalCurrency();
        $this->assertInstanceOf(OrderOriginalCurrency::class, $orderOriginalCurrency);
        $this->assertSame(0.0, $orderOriginalCurrency->getEbayShippingAmount());
        $this->assertSame(0.0, $orderOriginalCurrency->getShippingAmount());
        $this->assertSame(0.0, $orderOriginalCurrency->getPaymentSurcharge());
        $this->assertSame(0.0, $orderOriginalCurrency->getPaymentSurchargePerCent());
        $this->assertSame(112.3, $orderOriginalCurrency->getInvoiceAmount());
        $this->assertSame(0, $orderOriginalCurrency->getExchangeRate());
        $this->assertSame(112.3, $orderOriginalCurrency->getPayedAmount());

    }

    public function testUpdateVersion460(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetSoldItemsSuccess2.0.460.xml';

        $request = new GetSoldItemsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Orders $orders */
        $orders = $response->getResult();

        $expected = new Order(
            10075,
            43151135,
            9525249060,
            orderDate: new DateTime('2006-05-29 09:32:50'),
            paymentInfo: new PaymentInfo(
                PaymentIdEnum::INVOICE,
                alreadyPaid: 0.0,
                fullAmount: 110.05,
                invoiceDate: new DateTime('2006-06-01'),
            ),
            buyerInfo: new BuyerInfo(
                new BillingAddress(
                    29893553,
                    userIdPlattform: 'afterbuy1_testaccount',
                    firstName: 'Max',
                    lastName: 'Mustermann',
                    company: 'api1@via.de',
                    street: 'Kimplerstr. 296',
                    postalCode: '47807',
                    city: 'Krefeld',
                    country: 'D',
                    countryIsoEnum: CountryIsoEnum::GERMANY,
                    mail: 'musterman@muster.de',
                ),
                new ShippingAddress(
                    firstName: 'Tom',
                    lastName: 'Test',
                    company: 'Testcompany',
                    street: 'Testsreet 1',
                    postalCode: '15478',
                    city: 'Mustercity',
                    country: 'F',
                    countryIsoEnum: CountryIsoEnum::FRANCE,
                ),
            ),
            soldItems: new SoldItems(
                [
                    new SoldItem(
                        43151135,
                        itemTitle: 'Testartikel',
                        itemQuantity: 1,
                        itemPrice: 2.0,
                        itemEndDate: new DateTime('2006-05-29 09:32:50'),
                        taxRate: 19.0,
                        itemWeight: 4.13,
                        itemModDate: new DateTime('2006-06-02 14:01:46'),
                    ),
                    new SoldItem(
                        43159620,
                        itemTitle: 'Testartikel',
                        itemQuantity: 12,
                        itemPrice: 2.0,
                        itemEndDate: new DateTime('2006-05-29 09:33:24'),
                        taxRate: 16.0,
                        itemWeight: 0.34,
                        itemModDate: new DateTime('2006-06-02 14:01:46'),
                    ),
                    new SoldItem(
                        43161870,
                        itemTitle: 'Attributtest MB',
                        itemQuantity: 1,
                        itemPrice: 1.0,
                        itemEndDate: new DateTime('2006-05-29 12:50:03'),
                        taxRate: 16.0,
                        itemWeight: 4.13,
                        itemModDate: new DateTime('2006-06-02 14:01:46'),
                    ),
                ],
            ),
            shippingInfo: new ShippingInfo(
                shippingCost: 5.55,
                shippingAdditionalCost: 0,
                shippingTotalCost: 5.55,
                shippingTaxRate: 19.00,
                parcelLabels: [
                    new ParcelLabel(
                        43151135,
                        1,
                        '00340434464181524067',
                        '99353347120585',
                        packageQuantity: 1,
                    ),
                    new ParcelLabel(
                        43159620,
                        2,
                        '00340434464181524070',
                        '99353347120518',
                        packageWeight: 10.5,
                    ),
                    new ParcelLabel(
                        43161870,
                        3,
                        '00340434464181524023',
                        '99353347120545',
                        packageQuantity: 4,
                    ),
                ],
            ),
            feedbackDate: new DateTime('2006-06-01 11:43:38'),
            feedbackLink: 'https://www.afterbuy.de/fb.aspx?ui=452FAF74-C14F-4A02-A541-8FA281B92173',
        );

        $this->assertInstanceOf(GetSoldItemsResponse::class, $response);
        $this->assertSame(false, $orders->hasMoreItems());
        $this->assertCount(1, $orders->getOrders());
        $this->assertInstanceOf(Order::class, $orders->getOrders()[0]);
        $this->assertEquals($expected, $orders->getOrders()[0]);
    }
}
