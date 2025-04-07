# GetListerHistoryRequest
[back to index](./../README.md)

## Example
```php
<?php

use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Extends\DateTime;
use Wundii\AfterbuySdk\Filter\GetListerHistory\StartDate;
use Wundii\AfterbuySdk\Request\GetListerHistoryRequest;

$global = new AfterbuyGlobal(
    '123...',
    '456...',
);

$afterbuy = new Afterbuy(
    $global,
    EndpointEnum::SANDBOX,
);

$request = new GetListerHistoryRequest(maxHistoryItems: 10, filter: [
    new StartDate(new DateTime('2025-03-17 00:00:00'), new DateTime('now')),
]);
$response = $afterbuy->runRequest($request);

if ($response->getStatusCode() !== 200) {
    dump($response->getStatusCode());
    dump($response->getInfo());
    return;
}

$response->getCallStatus();
$response->getWarningMessages();
$response->getErrorMessages();

/** @var Wundii\AfterbuySdk\Dto\GetListerHistory\ListedItems $result */
$result = $response->getResult();
dump($result->hasMoreProducts());
dump($result->getResultCount());
dump($result->getLastHistoryId());
dump($result->getListedItems());
```
