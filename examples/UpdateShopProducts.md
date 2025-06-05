# UpdateShopProductsRequest
[back to index](./../README.md)

## Example
```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Product;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductIdent;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Request\UpdateShopProductsRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    EndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$request = new UpdateShopProductsRequest(
    [
        new Product(
            new ProductIdent(),
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

/** @var Wundii\AfterbuySdk\Dto\UpdateShopProducts\NewProducts $result */
$result = $response->getResult();
dump($result->getNewProducts());
```
