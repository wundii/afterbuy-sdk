# UpdateCatalogsRequest
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalog;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionCatalogsEnum;
use Wundii\AfterbuySdk\Request\UpdateCatalogsRequest;

$global = new AfterbuyGlobal(
    '123...',
    '456...',
);

$afterbuy = new Afterbuy(
    $global,
    EndpointEnum::SANDBOX,
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
