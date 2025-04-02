# GetStockInfoRequest
[back to index](./../README.md)

## Example
```php
<?php

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\ProductFilterEnum;
use AfterbuySdk\Filter\GetStockInfo\ProductFilter;
use AfterbuySdk\Request\GetStockInfoRequest;

$global = new AfterbuyGlobal(
    '123...',
    '456...',
);

$afterbuy = new Afterbuy(
    $global,
    EndpointEnum::SANDBOX,
);

$request = new GetStockInfoRequest(
    productFilter: [
        new ProductFilter(ProductFilterEnum::PRODUCTID, 1000),
        new ProductFilter(ProductFilterEnum::PRODUCTID, 1001),
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

/** @var AfterbuySdk\Dto\GetStockInfo\Products $result */
$result = $response->getResult();
dump($result->getProducts());
```
