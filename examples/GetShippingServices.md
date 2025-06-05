# GetShippingServicesRequest
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\AfterbuySdk\Request\GetShippingServicesRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    AfterbuyEndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$request = new GetShippingServicesRequest();
$response = $afterbuy->runRequest($request);

if ($response->getStatusCode() !== 200) {
    dump($response->getStatusCode());
    dump($response->getInfo());
    return;
}

$response->getCallStatus();
$response->getWarningMessages();
$response->getErrorMessages();

/** @var Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingServices $result */
$result = $response->getResult();
dump($result->getShippingServices());
```
