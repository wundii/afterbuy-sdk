# GetStockInfoRequest
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\ProductFilterEnum;
use Wundii\AfterbuySdk\Filter\GetStockInfo\ProductFilter;
use Wundii\AfterbuySdk\Request\GetStockInfoRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    EndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$request = new GetStockInfoRequest(
    productFilter: [
        new ProductFilter(ProductFilterEnum::ANR, 1000),
        new ProductFilter(ProductFilterEnum::PRODUCTID, 1001),
        new ProductFilter(ProductFilterEnum::EAN, 1002),
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

/** @var Wundii\AfterbuySdk\Dto\GetStockInfo\Products $result */
$result = $response->getResult();
dump($result->getProducts());
```
