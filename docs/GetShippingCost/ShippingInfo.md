# Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingInfo
- [Back to Structron Documentation](./../_Structron.md)
- [Go to ShippingInfo.php](./../../src/Dto/GetShippingCost/ShippingInfo.php)

Holds the shipping information for a product or products.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Enum\CountryIsoEnum | CountryIsoEnum |

## Properties
| ShippingInfo   | Type           | Default  | Description                                                        |
| -------------- | -------------- | -------- | ------------------------------------------------------------------ |
| productIds     | int[]          | required |                                                                    |
| itemsCount     | int            | required |                                                                    |
| itemsWeight    | float          | required | Total weight of all items, not per item                            |
| itemsPrice     | float          | required |                                                                    |
| countryIsoEnum | CountryIsoEnum | null     |                                                                    |
| shippingGroup  | string         | null     | Name (not ID) of the Afterbuy shipping group                       |
| PostalCode     | string         | null     | Delivery postcode; required to apply surcharges for German islands |
