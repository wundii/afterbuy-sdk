# UpdateShopProductsRequest
[back to index](./../README.md)

## Example
```php
<?php

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\UpdateShopProducts\Product;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\UpdateShopProductsRequest;

$global = new AfterbuyGlobal(
    '123...',
    '456...',
);

$afterbuy = new Afterbuy(
    $global,
    EndpointEnum::SANDBOX,
);

$request = new UpdateShopProductsRequest(
    [
        new Product(
            'new Product Name',
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

/** @var AfterbuySdk\Dto\UpdateShopProducts\NewProducts $result */
$result = $response->getResult();
dump($result->getNewProducts());
```
