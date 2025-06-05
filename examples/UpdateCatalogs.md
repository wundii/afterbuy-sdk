# UpdateCatalogsRequest
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalog;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionCatalogsEnum;
use Wundii\AfterbuySdk\Request\UpdateCatalogsRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    AfterbuyEndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$request = new UpdateCatalogsRequest(
    UpdateActionCatalogsEnum::CREATE,
    [
        new Catalog(
            1,
            '1. Hauptkatalog',
            'Das ist der erste Hauptkatalog & weitere',
            'https://www.example.com/catalog',
            0,
            1,
            'HK1',
            true,
            catalog: [
                new Catalog(
                    3,
                    '1. Unterkatalog zum 1. Hauptkataolog',
                    //...
                    position: 1,
                    showCatalog: true,
                    catalog: [
                        new Catalog(
                            4,
                            '1. Unterkatalog zum 1. Unterkataolog',
                            //...
                            position: 1,
                            showCatalog: true,
                        ),
                    ]
                ),
                new Catalog(
                    5,
                    '2. Unterkatalog zum 1. Hauptkataolog',
                    //...
                    position: 2,
                    showCatalog: true,
                ),
            ]
        ),
        new Catalog(
            2,
            '2. Hauptkatalog',
            //...
        ),
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

/** @var Wundii\AfterbuySdk\Dto\UpdateCatalogs\NewCatalogs $result */
$result = $response->getResult();
dump($result->getNewCatalogs());

// or

/** @var Wundii\AfterbuySdk\Dto\UpdateCatalogs\CatalogNotDeleteds $result */
$result = $response->getResult();
dump($result->getCatalogNotDeleteds());
```
