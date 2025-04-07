# afterbuy-sdk

[![AfterbuyXmlApi](https://img.shields.io/badge/Afterbuy%20XML--API-Version%202.0.459-yellow.svg?style=flat)](https://xmldoku.afterbuy.de/dokued)
[![PHP-Tests](https://github.com/wundii/afterbuy-sdk/actions/workflows/code_quality.yml/badge.svg)](https://github.com/wundii/afterbuy-sdk/actions/workflows/code_quality.yml)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%2010-brightgreen.svg?style=flat)](https://phpstan.org)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg?style=flat)](https://www.php.net/)
[![Rector](https://img.shields.io/badge/Rector-8.2-blue.svg?style=flat)](https://getrector.com)
[![ECS](https://img.shields.io/badge/ECS-check-blue.svg?style=flat)](https://tomasvotruba.com/blog/zen-config-in-ecs)
[![PHPUnit](https://img.shields.io/badge/PHP--Unit-check-blue.svg?style=flat)](https://phpunit.org)
[![PSR3](https://img.shields.io/badge/PSR--3%20Logger-optional-blue.svg?style=flat)](https://php-fig.org/psr/psr-3)

This is a modern Afterbuy Programming Interface Software Development Kit, for the selling solution [afterbuy.de](https://www.afterbuy.de/).

## Requirements
- PHP 8.2 or higher
- ext-dom
- ext-json
- ext-reflection
- ext-simplexml
- ext-xml

## Installation
Require the bundle and its dependencies with composer:

> composer require wundii/afterbuy-sdk

## Afterbuy API Documentation
[Afterbuy XML API Documentation](https://xmldoku.afterbuy.de/dokued/)

### Supported Requests with Examples
- [x] [GetAfterbuyTime](examples/GetAfterbuyTime.md)
- [x] [GetListerHistory](examples/GetListerHistory.md)
- [x] [GetMailTemplates](examples/GetMailTemplates.md)
- [x] [GetPaymentServices](examples/GetPaymentServices.md)
- [x] [GetProductDiscounts](examples/GetProductDiscounts.md)
- [x] [GetShippingCost](examples/GetShippingCost.md)
- [x] [GetShippingServices](examples/GetShippingServices.md)
- [x] [GetShopCatalogs](examples/GetShopCatalogs.md)
- [x] [GetShopProducts](examples/GetShopProducts.md)
- [x] [GetSoldItems](examples/GetSoldItems.md)
- [x] [GetStockInfo](examples/GetStockInfo.md)
- [x] [GetTranslatedMailTemplate](examples/GetTranslatedMailTemplate.md)
- [x] [UpdateCatalogs](examples/UpdateCatalogs.md)
- [x] [UpdateShopProducts](examples/UpdateShopProducts.md)
- [x] [UpdateSoldItems](examples/UpdateSoldItems.md)

## Usage
```php
use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Request\GetAfterbuyTimeRequest:

$afterbuyGlobal = new AfterbuyGlobal(
    accountToken: '123...',
    partnerToken: '456...',
);

$request = new GetAfterbuyTimeRequest();

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
    EndpointEnum::SANDBOX,
    Optional_PsrLoggerInterface::class,
);
$response = $afterbuy->runRequest($request);

$response->getStatusCode();
$response->getCallStatus();
$response->getInfo();
$response->getResult();
$response->getXmlResponse()
$response->getErrorMessages();
$response->getWarningMessages();
```