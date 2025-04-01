# afterbuy-sdk

[![PHP-Tests](https://github.com/wundii/afterbuy-sdk/actions/workflows/code_quality.yml/badge.svg)](https://github.com/wundii/afterbuy-sdk/actions/workflows/code_quality.yml)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%209-brightgreen.svg?style=flat)](https://phpstan.org/)

This is a modern Afterbuy Programming Interface Software Development Kit.

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

## Usage

```php
use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\GetAfterbuyTimeRequest:

$afterbuyGlobal = new AfterbuyGlobal(
    accountToken: '123...',
    partnerToken: '456...',
);

$request = new GetAfterbuyTimeRequest();

$afterbuy = new Afterbuy(
    $afterbuyGlobal,
    EndpointEnum::SANDBOX,
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