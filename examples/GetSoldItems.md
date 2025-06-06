# GetSoldItemsRequest
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\Core\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\DateFilterSoldItemsEnum;
use Wundii\AfterbuySdk\Enum\DefaultFilterSoldItemsEnum;
use Wundii\AfterbuySdk\Enum\PlattformEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AfterbuyUserEmail;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AfterbuyUserId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AlternativeItemNumber1;
use Wundii\AfterbuySdk\Filter\GetSoldItems\AlternativeItemNumber2;
use Wundii\AfterbuySdk\Filter\GetSoldItems\DateFilter;
use Wundii\AfterbuySdk\Filter\GetSoldItems\DefaultFilter;
use Wundii\AfterbuySdk\Filter\GetSoldItems\InvoiceNumber;
use Wundii\AfterbuySdk\Filter\GetSoldItems\OrderId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\Plattform;
use Wundii\AfterbuySdk\Filter\GetSoldItems\RangeOrderId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\ShopId;
use Wundii\AfterbuySdk\Filter\GetSoldItems\Tag;
use Wundii\AfterbuySdk\Filter\GetSoldItems\UserDefinedFlag;
use Wundii\AfterbuySdk\Request\GetSoldItemsRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    EndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$request = new GetSoldItemsRequest(
    detailLevelEnum: DetailLevelEnum::FIRST,
    requestAllItems: null,
    maxSoldItems: 10,
    orderDirectionEnum: OrderDirectionEnum::ASC,
    returnHiddenItems: true,
    filter: [
        new AfterbuyUserEmail('user@example.com'),
        new AfterbuyUserId(1234),
        new AlternativeItemNumber1('number01'),
        new AlternativeItemNumber2('number02'),
        new DateFilter(
            new DateTime('2025-05-01'), 
            new DateTime('2025-05-31'), 
            DateFilterSoldItemsEnum::AUCTION_END_DATE,
        ),
        new DefaultFilter(DefaultFilterSoldItemsEnum::INVOICEPRINTED),
        new InvoiceNumber(1000),
        new OrderId(2000),
        new Plattform(PlattformEnum::EBAY),
        new RangeOrderId(3000, 3010),
        new ShopId(4000),
        new Tag('myTag'),
        new UserDefinedFlag(5000),
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

/** @var Wundii\AfterbuySdk\Dto\GetSoldItems\Orders $result */
$result = $response->getResult();
dump($result->hasMoreItems());
dump($result->getOrders());
```
