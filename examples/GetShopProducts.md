# GetShopProductsRequest
[back to index](./../README.md)

## Example
```php
<?php

use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\DateFilterShopProductsEnum;
use Wundii\AfterbuySdk\Enum\DefaultFilterShopProductsEnum;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Extends\DateTime;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Anr;
use Wundii\AfterbuySdk\Filter\GetShopProducts\DateFilter;
use Wundii\AfterbuySdk\Filter\GetShopProducts\DefaultFilter;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Ean;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Level;
use Wundii\AfterbuySdk\Filter\GetShopProducts\ProductId;
use Wundii\AfterbuySdk\Filter\GetShopProducts\RangeAnr;
use Wundii\AfterbuySdk\Filter\GetShopProducts\RangeProductId;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Tag;  
use Wundii\AfterbuySdk\Request\GetShopProductsRequest;

$global = new AfterbuyGlobal(
    '123...',
    '456...',
);

$afterbuy = new Afterbuy(
    $global,
    EndpointEnum::SANDBOX,
);

$request = new GetShopProductsRequest(
    detailLevelEnum: DetailLevelEnum::FIRST,
    maxShopItems: 10,
    suppressBaseProductRelatedData: false,
    paginationEnabled: false,
    pageNumber: null,
    returnShop20Container: false,
    filter: [
        new Anr(1000),
        new DateFilter(
            new DateTime('2025-05-01'), 
            new DateTime('2025-05-31'), 
            DateFilterShopProductsEnum::LAST_SALE,
        ),
        new DefaultFilter(DefaultFilterShopProductsEnum::ALLSETS),
        new Ean('2000'),
        new Level(3000, 3010),
        new ProductId(4000),
        new RangeAnr(5000, 5010),
        new RangeProductId(6000, 6010),
        new Tag('myTag'),  
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

/** @var Wundii\AfterbuySdk\Dto\GetShopProducts\Products $result */
$result = $response->getResult();
dump($result->hasMoreProducts());
dump($result->getProducts());
dump($result->getLastProductId());
dump($result->getPaginationResult());
```
