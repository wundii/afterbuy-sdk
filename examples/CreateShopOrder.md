# CreateShopOrder
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Customer;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Order;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Product;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Enum\CurrencyEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\AfterbuySdk\Enum\NoFeedbackEnum;
use Wundii\AfterbuySdk\Enum\StockTypeEnum;
use Wundii\AfterbuySdk\Request\CreateShopOrderRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    AfterbuyEndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$order = new Order(
    customerIdentificationEnum: CustomerIdentificationEnum::EMAIL_ADDRESS,
    productIdentificationEnum: ProductIdentificationEnum::AFTERBUY_EXTERNAL_ITEM_NUMBER,
    stockTypeEnum: StockTypeEnum::SHOP,
    buyDate: new DateTime('now'),
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

$request = new CreateShopOrderRequest($order);
$response = $afterbuy->runRequest($request);

if ($response->getStatusCode() !== 200) {
    dump($response->getStatusCode());
    dump($response->getInfo());
    return;
}

$response->getCallStatus();
$response->getWarningMessages();
$response->getErrorMessages();

/** @var Wundii\AfterbuySdk\Dto\CreateShopOrder\ShopResponse $result */
$result = $response->getResult();
$result->getAid();
$result->getUid();
$result->getKundenNr();
$result->getEkundenNr();
```