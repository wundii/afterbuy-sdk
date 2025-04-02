# GetShippingCostRequest
[back to index](./../README.md)

## Example
```php
<?php

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetShippingCost\ShippingInfo;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\GetShippingCostRequest;

$global = new AfterbuyGlobal(
    '123...',
    '456...',
);

$afterbuy = new Afterbuy(
    $global,
    EndpointEnum::SANDBOX,
);

$shippingInfo = new ShippingInfo(
    123456,
    10,
    3,
    0,
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

/** @var AfterbuySdk\Dto\GetShippingCost\ShippingService $result */
$result = $response->getResult();
dump($result->getShippingServiceName());
dump($result->getShippingServicePriority());
dump($result->getShippingMethods());
```
