# Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingServices
- [Back to Structron Documentation](./../_Structron.md)
- [Go to ShippingServices.php](./../../src/Dto/GetShippingServices/ShippingServices.php)

Holds a list of shipping services.

| ShippingServices                                    | Type                                                         | Default  | Description |
| --------------------------------------------------- | ------------------------------------------------------------ | -------- | ----------- |
| **shippingServices**                                | Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingService[] | []       |             |
| &nbsp; shippingServices.name                        | string                                                       | required |             |
| &nbsp; shippingServices.displayArea                 | string                                                       | null     |             |
| &nbsp; shippingServices.groupPrio                   | int                                                          | 0        |             |
| **&nbsp; shippingServices.shippingMethods**         | Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingMethod[]  | []       |             |
| &nbsp; &nbsp; shippingMethods.shippingMethodID      | int                                                          | required |             |
| &nbsp; &nbsp; shippingMethods.name                  | string                                                       | required |             |
| &nbsp; &nbsp; shippingMethods.countryGroup          | string                                                       | null     |             |
| &nbsp; &nbsp; shippingMethods.countryGroupCountries | string                                                       | null     |             |
| &nbsp; &nbsp; shippingMethods.level                 | int                                                          | null     |             |
| &nbsp; &nbsp; shippingMethods.taxRate               | float                                                        | null     |             |
| &nbsp; &nbsp; shippingMethods.priceFrom             | float                                                        | null     |             |
| &nbsp; &nbsp; shippingMethods.priceTo               | float                                                        | null     |             |
| &nbsp; &nbsp; shippingMethods.islandAdditionalCosts | float                                                        | null     |             |
| &nbsp; &nbsp; shippingMethods.freeShippingPriceFrom | float                                                        | null     |             |
| &nbsp; &nbsp; shippingMethods.additionalItemCosts   | float                                                        | null     |             |
| **&nbsp; &nbsp; shippingMethods.weightDefinitions** | Wundii\AfterbuySdk\Dto\GetShippingServices\WeightDefinitions | null     |             |
| &nbsp; &nbsp; &nbsp; weightDefinitions.weightFrom   | float                                                        | required |             |
| &nbsp; &nbsp; &nbsp; weightDefinitions.weightTo     | float                                                        | required |             |
| &nbsp; &nbsp; &nbsp; weightDefinitions.price        | float                                                        | required |             |
