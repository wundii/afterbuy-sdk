# afterbuy-sdk

[![AfterbuyXmlApi](https://img.shields.io/badge/Afterbuy%20XML--API-Version%202.0.460-yellow.svg?style=flat)](https://xmldoku.afterbuy.de/dokued)
[![PHP-Tests](https://github.com/wundii/afterbuy-sdk/actions/workflows/code_quality.yml/badge.svg)](https://github.com/wundii/afterbuy-sdk/actions/workflows/code_quality.yml)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%2010-brightgreen.svg?style=flat)](https://phpstan.org)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg?style=flat)](https://www.php.net/)
[![Rector](https://img.shields.io/badge/Rector-8.2-blue.svg?style=flat)](https://getrector.com)
[![ECS](https://img.shields.io/badge/ECS-check-blue.svg?style=flat)](https://tomasvotruba.com/blog/zen-config-in-ecs)
[![PHPUnit](https://img.shields.io/badge/PHP--Unit-check-blue.svg?style=flat)](https://phpunit.org)
[![PSR3](https://img.shields.io/badge/PSR--3%20Logger-optional-blue.svg?style=flat)](https://php-fig.org/psr/psr-3)
[![Downloads](https://img.shields.io/packagist/dt/wundii/afterbuy-sdk.svg?style=flat)](https://packagist.org/packages/wundii/afterbuy-sdk)

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

## Afterbuy Sandbox Environment

```php
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts;
use Wundii\AfterbuySdk\Enum\EndpointEnum;

$global = new AfterbuyGlobal(
    '123...',
    '456...',
);

$afterbuy = new Afterbuy(
    $global,
    EndpointEnum::SANDBOX,
);

$afterbuy->runRequest(
    new UpdateShopProducts(
        ... // afterbuy sdk request object
    ),
);
```
According to the Afterbuy documentation, the scheme should be changed from https to http for the test environment.
However, this is currently not working as expected - all changes continue to affect the production environment.
This afterbuy sdk always returns default a successful response if it is an update request.
Alternatively, you can pass your own update response class.

```php
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Core\AfterbuySandboxResponse;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts;
use Wundii\AfterbuySdk\Enum\EndpointEnum;

$global = new AfterbuyGlobal(
    '123...',
    '456...',
);

$afterbuy = new Afterbuy(
    $global,
    EndpointEnum::SANDBOX,
);

/** your own response version */
$afterbuy->runRequest(
    new UpdateShopProducts(
        ... // afterbuy sdk request object
    ),
    new AfterbuySandboxResponse('<your custom xml response here>', 200),
);
```

## The road to Version 1.0
In preparation for the release of version 1.0.
- [x] GetAfterbuyTime, test XML returns
- [x] GetListerHistory, test XML returns
- [x] GetMailTemplates, test XML returns
- [x] GetPaymentServices, test XML returns
- [ ] <s>GetProductDiscounts, test XML returns</s>
- [x] GetShippingCost, test XML returns
- [x] GetShippingServices, test XML returns
- [x] GetShopCatalogs, test XML returns
- [x] GetShopProducts, test XML returns
- [x] GetSoldItems, test XML returns
- [x] GetStockInfo, test XML returns
- [x] GetTranslatedMailTemplate, test XML returns
- [x] UpdateCatalogs, test XML returns
- [x] UpdateShopProducts, test XML returns
- [x] UpdateSoldItems, test XML returns
- [x] DetailLevelEnum combination
- [x] AfterbuyGlobal namespace refactoring
- [x] AfterbuyGlobalInterface implementation
- [x] Sandbox and Production environment testing
- [x] Unittest for the Validator classes
- [x] first important asserts for the UpdateRequest classes
- [ ] final productive testing

## Usage

```php
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Request\GetAfterbuyTimeRequest;

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

## Development for Afterbuy SDK

### composer scripts

```shell
composer cache-clear
composer ecs-apply
composer ecs-dry
composer phpstan
composer rector-apply
composer rector-dry
composer unittest
```

### complete checks before merge

```shell
composer complete-check
```