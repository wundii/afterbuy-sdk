# GetUserDefinedFlagsRequest
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Request\GetUserDefinedFlagsRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    EndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$request = new GetUserDefinedFlagsRequest();
$response = $afterbuy->runRequest($request);

if ($response->getStatusCode() !== 200) {
    dump($response->getStatusCode());
    dump($response->getInfo());
    return;
}

$response->getCallStatus();
$response->getWarningMessages();
$response->getErrorMessages();

/** @var Wundii\AfterbuySdk\Dto\GetUserDefinedFlags\UserDefinedFlags $result */
$result = $response->getResult();
dump($result->getUserDefinedFlags());
```
