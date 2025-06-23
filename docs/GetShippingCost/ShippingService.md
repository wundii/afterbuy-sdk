# Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingService
- [Back to Structron Documentation](./../_Structron.md)
- [Go to ShippingService.php](./../../src/Dto/GetShippingCost/ShippingService.php)

Holds a list of payment services.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingMethods | ShippingMethods |

## Properties
| ShippingService                           | Type              | Default  | Description |
| ----------------------------------------- | ----------------- | -------- | ----------- |
| shippingServiceName                       | string            | required |             |
| shippingServicePriority                   | string            | required |             |
| **shippingMethods**                       | ShippingMethods[] | []       |             |
| shippingMethods.shippingCost              | float             | required |             |
| shippingMethods.shippingMethod            | string            | required |             |
| shippingMethods.shippingMethodId          | int               | required |             |
| shippingMethods.shippingTaxRate           | float             | null     |             |
| shippingMethods.shippingMethodDescription | string            | null     |             |
