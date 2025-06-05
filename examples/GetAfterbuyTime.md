# GetAfterbuyTime
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\AfterbuySdk\Request\GetAfterbuyTimeRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    AfterbuyEndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$request = new GetAfterbuyTimeRequest();
$response = $afterbuy->runRequest($request);

if ($response->getStatusCode() !== 200) {
    dump($response->getStatusCode());
    dump($response->getInfo());
    return;
}

$response->getCallStatus();
$response->getWarningMessages();
$response->getErrorMessages();

/** @var Wundii\AfterbuySdk\Dto\GetAfterbuyTime\AfterbuyTime $result */
$result = $response->getResult();
dump($result->getAfterbuyTimeStamp());
dump($result->getAfterbuyUniversalTimeStamp());
```