# GetTranslatedMailTemplateRequest
[back to index](./../README.md)

## Example
```php
<?php

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\GetTranslatedMailTemplateRequest;

$global = new AfterbuyGlobal(
    '123...',
    '456...',
);

$afterbuy = new Afterbuy(
    $global,
    EndpointEnum::SANDBOX,
);

$request = new GetTranslatedMailTemplateRequest(10203040, true, templateText: 'Hallo Test');
$response = $afterbuy->runRequest($request);

if ($response->getStatusCode() !== 200) {
    dump($response->getStatusCode());
    dump($response->getInfo());
    return;
}

$response->getCallStatus();
$response->getWarningMessages();
$response->getErrorMessages();

/** @var AfterbuySdk\Dto\GetTranslatedMailTemplate\TranslatedMailText $result */
$result = $response->getResult();
dump($result->getTranslatedMailSubject());
dump($result->getTranslatedMailText());
```
