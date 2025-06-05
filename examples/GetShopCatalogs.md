# GetShopCatalogsRequest
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\AfterbuyDetailLevelEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\CatalogId;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\Level;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\RangeCatalogId;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\RangeLevel;
use Wundii\AfterbuySdk\Request\GetShopCatalogsRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    AfterbuyEndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$request = new GetShopCatalogsRequest(
    filter: [
        new CatalogId(1000),
        new Level(2000),
        new RangeCatalogId(3000, 3010),
        new RangeLevel(4000, 4010),
    ],
    maxCatalogs: 10,
    detailLevelEnum: AfterbuyDetailLevelEnum::FIRST,
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

/** @var Wundii\AfterbuySdk\Dto\GetShopCatalogs\Catalogs $result */
$result = $response->getResult();
dump($result->hasMoreCatalogs());
dump($result->getCatalogs());
```
