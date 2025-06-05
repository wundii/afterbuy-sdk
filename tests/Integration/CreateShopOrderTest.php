<?php

declare(strict_types=1);

namespace Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Addition;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Customer;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\DeliveryAddress;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Order;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Payment;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Product;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Shipping;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\ShopResponse;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Enum\CurrencyEnum;
use Wundii\AfterbuySdk\Enum\CustomerIdentificationEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\NoFeedbackEnum;
use Wundii\AfterbuySdk\Enum\PaymentMethodIdEnum;
use Wundii\AfterbuySdk\Enum\ProductIdentificationEnum;
use Wundii\AfterbuySdk\Enum\StockTypeEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Extension\HttpClientHelper;
use Wundii\AfterbuySdk\Interface\RequestDtoInterface;
use Wundii\AfterbuySdk\Request\CreateShopOrderRequest;
use Wundii\AfterbuySdk\Response\CreateShopOrderResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class CreateShopOrderTest extends TestCase
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

    public function getSandboxUrl(): string
    {
        return 'http://api.afterbuy.de/afterbuy/ShopInterface.aspx';
    }

    public function getOrderMininum(DateTime $buyDate): Order
    {
        return new Order(
            customerIdentificationEnum: CustomerIdentificationEnum::EMAIL_ADDRESS,
            productIdentificationEnum: ProductIdentificationEnum::AFTERBUY_EXTERNAL_ITEM_NUMBER,
            stockTypeEnum: StockTypeEnum::SHOP,
            buyDate: $buyDate,
            reference: 'TestOrder123',
            currencyEnum: CurrencyEnum::EURO,
            doNotShowVat: false,
            noFeedbackEnum: NoFeedbackEnum::SET_FEEDBACK_DATE_NO_EMAIL,
            customer: new Customer(
                'Mustermann',
                'mustermann@example.com',
                'Max',
                'Mustermann',
                'Musterstraße 1',
                '12345',
                'Musterstadt',
                CountryIsoEnum::GERMANY,
            ),
            products: [
                new Product(
                    1234567890,
                    'Test Product',
                    29.99,
                    19.0,
                    2,
                ),
            ],
        );
    }

    public function testShopOrderUriMinimum(): void
    {
        $buyDate = new DateTime('now');

        $request = new CreateShopOrderRequest($this->getOrderMininum($buyDate));

        $url = $request->url(EndpointEnum::SANDBOX);
        $query = $request->query();

        $expectedUri = $this->getSandboxUrl() . '?Action=new' .
            '&Kundenerkennung=1&Artikelerkennung=2&Bestandart=shop&BuyDate=' . $buyDate->format('d.m.Y%20H:i:s') .
            '&reference=TestOrder123&SoldCurrency=EUR&MwStNichtAusweisen=0&NoFeedback=0' .
            '&kbenutzername=Mustermann&KVorname=Max&KNachname=Mustermann&KStrasse=Musterstra%C3%9Fe%201&KPLZ=12345&KOrt=Musterstadt&Kemail=mustermann@example.com&KLand=DE' .
            '&PosAnz=1&Artikelnr_1=1234567890&Artikelname_1=Test%20Product&ArtikelEpreis_1=29%2C99&ArtikelMwSt_1=19%2C00&ArtikelMenge_1=2';

        $this->assertSame($expectedUri, HttpClientHelper::prepareUri($url, $query));
    }

    public function testShopOrderUriMaximum(): void
    {
        $buyDate = new DateTime('now');
        $payDate = new DateTime('2025-06-03 12:00:00');
        $birthDay = new DateTime('2000-01-01');

        $order = new Order(
            customerIdentificationEnum: CustomerIdentificationEnum::EMAIL_ADDRESS,
            productIdentificationEnum: ProductIdentificationEnum::AFTERBUY_EXTERNAL_ITEM_NUMBER,
            stockTypeEnum: StockTypeEnum::SHOP,
            buyDate: $buyDate,
            reference: 'TestOrder123',
            currencyEnum: CurrencyEnum::EURO,
            doNotShowVat: false,
            noFeedbackEnum: NoFeedbackEnum::SET_FEEDBACK_DATE_NO_EMAIL,
            customer: new Customer(
                'Mustermann',
                'mustermann@example.com',
                'Max',
                'Mustermann',
                'Musterstraße 1',
                '12345',
                'Musterstadt',
                CountryIsoEnum::GERMANY,
                1234,
                dealer: true,
                ustid: 'DE123456789',
                salutation: 'Herr',
                company: 'Musterfirma GmbH',
                street2: 'Musterstraße 2',
                state: 'Sachsen',
                phone: '0123456789',
                fax: '0123456790',
                birthday: $birthDay,
            ),
            deliveryAddress: new DeliveryAddress(
                'Erika',
                'Mustermann',
                'Musterstraße 3',
                '22335',
                'Musterstadt',
                CountryIsoEnum::FRANCE,
                company: 'Musterfirma GmbH',
                street2: 'Musterstraße 4',
                phone: '01234567891',
            ),
            products: [
                new Product(
                    1234567890,
                    'Test Product',
                    29.99,
                    19.0,
                    2,
                    weight: 12.2,
                    productUrl: 'https://example.com/product',
                    attribute: 'farbe=blau|größe=L',
                    productId: 1234,
                    alternativeAnr1: '1000',
                    alternativeAnr2: '1001',
                    tags: [
                        'TestTag1',
                        'TestTag2',
                    ]
                ),
                new Product(
                    1234567891,
                    'Test Product2',
                    15.99,
                    19.0,
                    1,
                ),
            ],
            shipping: new Shipping(
                'Standardversand',
                'standard',
                5.95,
                'afterbuy',
                true,
                false,
                true,
            ),
            payment: new Payment(
                paymentMethodIdEnum: PaymentMethodIdEnum::BANK_TRANSFER,
                paymentMethodCustom: 'do not show',
                payed: true,
                payDate: $payDate,
                paymentMethodSurcharge: 1.50,
                paymentStatus: 'success',
                paymentTransactionId: '1234567890',
                bankAccountOwner: '',
                bankName: 'Musterfirma GmbH',
                bankAccountNumber: '00123456789',
                blz: '123456789',
                bic: 'DEUTDEDBFRA',
                iban: 'DE89370400440532013000',
                billSafeTransactionId: '1234567890',
                billSafeOrderNumber: '123',
            ),
            addition: new Addition(
                comment: 'lorem ipsum dolor sit amet',
                memo: 'consectetur adipiscing elit',
                useComplWeight: true,
                useProductTaxRate: false,
                orderInfo1: 'order info 1',
                orderInfo2: 'order info 2',
                orderInfo3: 'order info 3',
                markerId: 1234,
                noEbayName: true,
                vid: '1234567890',
                checkVid: false,
            ),
        );
        $request = new CreateShopOrderRequest($order);

        $url = $request->url(EndpointEnum::SANDBOX);
        $query = $request->query();

        $expectedUri = $this->getSandboxUrl() . '?Action=new' .
            '&Kundenerkennung=1&Artikelerkennung=2&Bestandart=shop&BuyDate=' . $buyDate->format('d.m.Y%20H:i:s') .
            '&reference=TestOrder123&SoldCurrency=EUR&MwStNichtAusweisen=0&NoFeedback=0' .
            '&kbenutzername=Mustermann&Haendler=1&EKundenNr=1234&Kanrede=Herr&KFirma=Musterfirma%20GmbH&UsStID=DE123456789&KVorname=Max&KNachname=Mustermann&KStrasse=Musterstra%C3%9Fe%201&KStrasse2=Musterstra%C3%9Fe%202&KPLZ=12345&KOrt=Musterstadt&KBundesland=Sachsen&Ktelefon=0123456789&Kfax=0123456790&Kemail=mustermann@example.com&KLand=DE&KBirthday=01.01.2000' .
            '&Lieferanschrift=1&KLFirma=Musterfirma%20GmbH&KLVorname=Erika&KLNachname=Mustermann&KLStrasse=Musterstra%C3%9Fe%203&KLStrasse2=Musterstra%C3%9Fe%204&KLPLZ=22335&KLOrt=Musterstadt&KLLand=FR&KLTelefon=01234567891' .
            '&PosAnz=2&Artikelnr_1=1234567890&AlternArtikelNr1_1=1000&AlternArtikelNr2_1=1001&Artikelname_1=Test%20Product&ArtikelEpreis_1=29%2C99&ArtikelMwSt_1=19%2C00&ArtikelMenge_1=2&ArtikelGewicht_1=12%2C20&ArtikelLink_1=https://example.com/product&Attribute_1=farbe%3Dblau%7Cgr%C3%B6%C3%9Fe%3DL&ArtikelStammID_1=1234&Tag_1_1=TestTag1&Tag_2_1=TestTag2' .
            '&Artikelnr_2=1234567891&Artikelname_2=Test%20Product2&ArtikelEpreis_2=15%2C99&ArtikelMwSt_2=19%2C00&ArtikelMenge_2=1' .
            '&Versandgruppe=Standardversand&Versandart=standard&Versandkosten=5%2C95&ReturnCarrier=afterbuy&NoVersandCalc=1&CheckPackstation=0&OverrideMarkID=1' .
            '&ZahlartID=1&SetPay=1&SetPayDate=03.06.2025%2012:00:00&ZahlartenAufschlag=1%2C50&PaymentStatus=success&PaymentTransactionID=1234567890&Bankname=Musterfirma%20GmbH&Kontonummer=00123456789&BLZ=123456789&BIC=DEUTDEDBFRA&IBAN=DE89370400440532013000&BillsafeTransactionID=1234567890&BillsafeOrderNumber=123' .
            '&Kommentar=lorem%20ipsum%20dolor%20sit%20amet&VMemo=consectetur%20adipiscing%20elit&UseComplWeight=1&UseProductTaxRate=0&OrderInfo1=order%20info%201&OrderInfo2=order%20info%202&OrderInfo3=order%20info%203&MarkierungID=1234&NoeBayNameAktu=1&VID=1234567890&CheckVID=0';

        $this->assertSame($expectedUri, HttpClientHelper::prepareUri($url, $query));
    }

    public function testValidateOrder(): void
    {
        $buyDate = new DateTime('now');

        $order = new Order(
            customerIdentificationEnum: CustomerIdentificationEnum::EMAIL_ADDRESS,
            productIdentificationEnum: ProductIdentificationEnum::AFTERBUY_EXTERNAL_ITEM_NUMBER,
            stockTypeEnum: StockTypeEnum::SHOP,
            buyDate: $buyDate,
            reference: str_repeat('a', 50),
            currencyEnum: CurrencyEnum::EURO,
            doNotShowVat: false,
            noFeedbackEnum: NoFeedbackEnum::SET_FEEDBACK_DATE_NO_EMAIL,
            customer: new Customer(
                'Mustermann',
                'mustermann@example.com',
                'Max',
                'Mustermann',
                'Musterstraße 1',
                '12345',
                'Musterstadt',
                CountryIsoEnum::GERMANY,
            ),
            products: [
                new Product(
                    1234567890,
                    'Test Product',
                    29.99,
                    19.0,
                    2,
                ),
            ],
        );
        $request = new CreateShopOrderRequest($order);

        $errors = $this->validate($request->requestDto());
        $this->assertEquals([], $errors);

        $order = new Order(
            customerIdentificationEnum: CustomerIdentificationEnum::EMAIL_ADDRESS,
            productIdentificationEnum: ProductIdentificationEnum::AFTERBUY_EXTERNAL_ITEM_NUMBER,
            stockTypeEnum: StockTypeEnum::SHOP,
            buyDate: $buyDate,
            reference: str_repeat('a', 51),
            currencyEnum: CurrencyEnum::EURO,
            doNotShowVat: false,
            noFeedbackEnum: NoFeedbackEnum::SET_FEEDBACK_DATE_NO_EMAIL,
            customer: new Customer(
                str_repeat('a', 51),
                'mustermann@example.com',
                'Max',
                'Mustermann',
                'Musterstraße 1',
                '12345',
                'Musterstadt',
                CountryIsoEnum::GERMANY,
            ),
            products: array_fill(0, 7, new Product(
                1234567890,
                'Test Product',
                29.99,
                19.0,
                2,
            )),
        );

        $request = new CreateShopOrderRequest($order);

        $errors = $this->validate($request->requestDto());

        $expectedErrors = [
            'reference: This value is too long. It should have 50 characters or less.',
            'customer.username: This value is too long. It should have 50 characters or less.',
            'products: This collection should contain 6 elements or less.',
        ];
        $this->assertEquals($expectedErrors, $errors);
    }

    public function testCreateShopOrderResponseError(): void
    {
        $file = __DIR__ . '/ResponseFiles/CreateShopOrderError.xml';

        $buyDate = new DateTime('now');
        $request = new CreateShopOrderRequest($this->getOrderMininum($buyDate));
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        /**
         * responseTrait muss für die andere errorlogik angepasst werden -,-
         */
        $response = $afterbuy->runRequest($request, $mockResponse);

        $shopResponse = $response->getResult();

        $expectedShopResponse = new ShopResponse();

        $this->assertInstanceOf(CreateShopOrderResponse::class, $response);
        $this->assertEquals(CallStatusEnum::ERROR, $response->getCallStatus());
        $this->assertCount(1, $response->getErrorMessages());
        $this->assertEquals('Code 0: SSL erforderlich', $response->getErrorMessages()[0]->getMessage());
        $this->assertInstanceOf(ShopResponse::class, $shopResponse);
        $this->assertEquals($expectedShopResponse, $shopResponse);
    }

    public function testCreateShopOrderResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/CreateShopOrderSuccess.xml';

        $buyDate = new DateTime('now');
        $request = new CreateShopOrderRequest($this->getOrderMininum($buyDate));
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $shopResponse = $response->getResult();

        $expectedShopResponse = new ShopResponse(
            1234567,
            '1868E8AB-6D6F-49EB-8C6A-4B6325DFF190',
            9876543,
            10267,
        );

        $this->assertInstanceOf(CreateShopOrderResponse::class, $response);
        $this->assertEquals(CallStatusEnum::SUCCESS, $response->getCallStatus());
        $this->assertInstanceOf(ShopResponse::class, $shopResponse);
        $this->assertEquals($expectedShopResponse, $shopResponse);
    }
}
