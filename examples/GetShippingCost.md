# GetShippingCostRequest
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingInfo;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Request\GetShippingCostRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    EndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$shippingInfo = new ShippingInfo(
    productIds: 123456,
    itemsCount: 10,
    itemsWeight: 3.0,
    itemsPrice: 49.95,
);
$request = new GetShippingCostRequest($shippingInfo);
$response = $afterbuy->runRequest($request);

if ($response->getStatusCode() !== 200) {
    dump($response->getStatusCode());
    dump($response->getInfo());
    return;
}

$response->getCallStatus();
$response->getWarningMessages();
$response->getErrorMessages();

/** @var Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingService $result */
$result = $response->getResult();
dump($result->getShippingServiceName());
dump($result->getShippingServicePriority());
dump($result->getShippingMethods());
```
