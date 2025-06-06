# GetListerHistoryRequest
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\PlattformEnum;
use Wundii\AfterbuySdk\Enum\SiteIdEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Filter\GetListerHistory\AccountId;
use Wundii\AfterbuySdk\Filter\GetListerHistory\Anr;
use Wundii\AfterbuySdk\Filter\GetListerHistory\EndDate;
use Wundii\AfterbuySdk\Filter\GetListerHistory\HistoryId;
use Wundii\AfterbuySdk\Filter\GetListerHistory\ListingType;
use Wundii\AfterbuySdk\Filter\GetListerHistory\Plattform;
use Wundii\AfterbuySdk\Filter\GetListerHistory\RangeAnr;
use Wundii\AfterbuySdk\Filter\GetListerHistory\RangeHist;
use Wundii\AfterbuySdk\Filter\GetListerHistory\SiteId;
use Wundii\AfterbuySdk\Filter\GetListerHistory\StartDate;
use Wundii\AfterbuySdk\Request\GetListerHistoryRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    EndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$request = new GetListerHistoryRequest(
    filter: [
        new StartDate(
            new DateTime('2025-03-17 00:00:00'),
            new DateTime('now'),
        ),
        new EndDate(
            new DateTime('2025-03-17 00:00:00'),
            new DateTime('now'),
        ),
        new AccountId(1000),
        new Anr(2000),
        new HistoryId(3000),
        new ListingType(1),
        new Plattform(PlattformEnum::EBAY),
        new RangeAnr(4000, 4010),
        new RangeHistoryId(5000, 5010),
        new SiteId(SiteIdEnum::EBAY_COM),
    ],
    maxHistoryItems: 10,
    detailLevelEnum: DetailLevelEnum::FIRST,
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

/** @var Wundii\AfterbuySdk\Dto\GetListerHistory\ListedItems $result */
$result = $response->getResult();
dump($result->hasMoreProducts());
dump($result->getResultCount());
dump($result->getLastHistoryId());
dump($result->getListedItems());
```
