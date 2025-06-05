# UpdateSoldItemsRequest
[back to index](./../README.md)

## Example
```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\Order;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Request\UpdateSoldItemsRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    EndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$request = new UpdateSoldItemsRequest(
    [
        new Order(
            12345600,
            1000,
            // ...
        )
    ]
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

/** @var null $result */
$result = $response->getResult();
dump($result); // null
```
