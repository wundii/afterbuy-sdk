# GetPaymentServicesRequest
[back to index](./../README.md)

## Example
```php
<?php

use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Filter\GetPaymentServices\Land;
use Wundii\AfterbuySdk\Filter\GetPaymentServices\Plattform;
use Wundii\AfterbuySdk\Filter\GetPaymentServices\ValueOfGoods;
use Wundii\AfterbuySdk\Request\GetPaymentServicesRequest;

$global = new AfterbuyGlobal(
    '123...',
    '456...',
);

$afterbuy = new Afterbuy(
    $global,
    EndpointEnum::SANDBOX,
);

$request = new GetPaymentServicesRequest(
    filter: [
        new Land(CountryIsoEnum::GERMANY),
        new Plattform('ebay'),
        new ValueOfGoods(99.95),
    ],
);
$response = $afterbuy->runRequest($request);

if ($response->getStatusCode() !== 200) {
    dump($response->getStatusCode());
    dump($response->getInfo());
    return;
}

$response->getCallStatus();
$response->getWarningMessages();
$response->getErrorMessages();

/** @var Wundii\AfterbuySdk\Dto\GetPaymentServices\PaymentServices $result */
$result = $response->getResult();
dump($result->getPaymentService());
```
