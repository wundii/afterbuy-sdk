# GetListerHistoryRequest
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\PlattformEnum;
use Wundii\AfterbuySdk\Enum\SiteIdEnum;
use Wundii\AfterbuySdk\Extends\DateTime;
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

$global = new AfterbuyGlobal(
    '123...',
    '456...',
);

$afterbuy = new Afterbuy(
    $global,
    EndpointEnum::SANDBOX,
);

$request = new GetListerHistoryRequest(
    detailLevelEnum: DetailLevelEnum::FIRST,
    maxHistoryItems: 10, 
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
