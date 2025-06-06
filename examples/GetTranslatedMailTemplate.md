# GetTranslatedMailTemplateRequest
[back to index](./../README.md)

## Example

```php
<?php

use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Filter\GetTranslatedMailTemplate\TemplateId;
use Wundii\AfterbuySdk\Filter\GetTranslatedMailTemplate\TemplateName;
use Wundii\AfterbuySdk\Request\GetTranslatedMailTemplateRequest;

$afterbuyGlobal = new AfterbuyGlobal(
    '123...',
    '456...',
    EndpointEnum::SANDBOX,
);

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
);

$request = new GetTranslatedMailTemplateRequest(
    offerId: 10203040, 
    useTemplate: true,
    templateText: 'Hallo Test',
    filter: [
        new TemplateId(1000),
        new TemplateName('Erstkontakt'),
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

/** @var Wundii\AfterbuySdk\Dto\GetTranslatedMailTemplate\TranslatedMailText $result */
$result = $response->getResult();
dump($result->getTranslatedMailSubject());
dump($result->getTranslatedMailText());
```
