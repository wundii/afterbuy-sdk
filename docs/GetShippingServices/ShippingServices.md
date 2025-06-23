# Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingServices
- [Back to Structron Documentation](./../_Structron.md)
- [Go to ShippingServices.php](./../../src/Dto/GetShippingServices/ShippingServices.php)

Holds a list of shipping services.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingMethod | ShippingMethod |
| Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingService | ShippingService |
| Wundii\AfterbuySdk\Dto\GetShippingServices\WeightDefinitions | WeightDefinitions |

## Properties
| ShippingServices                      | Type              | Default  | Description |
| ------------------------------------- | ----------------- | -------- | ----------- |
| **shippingServices**                  | ShippingService[] | []       |             |
| shippingServices.name                 | string            | required |             |
| shippingServices.displayArea          | string            | null     |             |
| shippingServices.groupPrio            | int               | 0        |             |
| **shippingServices.shippingMethods**  | ShippingMethod[]  | []       |             |
| shippingMethods.shippingMethodID      | int               | required |             |
| shippingMethods.name                  | string            | required |             |
| shippingMethods.countryGroup          | string            | null     |             |
| shippingMethods.countryGroupCountries | string            | null     |             |
| shippingMethods.level                 | int               | null     |             |
| shippingMethods.taxRate               | float             | null     |             |
| shippingMethods.priceFrom             | float             | null     |             |
| shippingMethods.priceTo               | float             | null     |             |
| shippingMethods.islandAdditionalCosts | float             | null     |             |
| shippingMethods.freeShippingPriceFrom | float             | null     |             |
| shippingMethods.additionalItemCosts   | float             | null     |             |
| **shippingMethods.weightDefinitions** | WeightDefinitions | null     |             |
| weightDefinitions.weightFrom          | float             | required |             |
| weightDefinitions.weightTo            | float             | required |             |
| weightDefinitions.price               | float             | required |             |
