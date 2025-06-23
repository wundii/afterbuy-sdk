# Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingService
- [Back to Structron Documentation](./../_Structron.md)
- [Go to ShippingService.php](./../../src/Dto/GetShippingCost/ShippingService.php)

Holds a list of payment services.

| ShippingService                                  | Type                                                     | Default  | Description |
| ------------------------------------------------ | -------------------------------------------------------- | -------- | ----------- |
| shippingServiceName                              | string                                                   | required |             |
| shippingServicePriority                          | string                                                   | required |             |
| **shippingMethods**                              | Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingMethods[] | []       |             |
| &nbsp; shippingMethods.shippingCost              | float                                                    | required |             |
| &nbsp; shippingMethods.shippingMethod            | string                                                   | required |             |
| &nbsp; shippingMethods.shippingMethodId          | int                                                      | required |             |
| &nbsp; shippingMethods.shippingTaxRate           | float                                                    | null     |             |
| &nbsp; shippingMethods.shippingMethodDescription | string                                                   | null     |             |
