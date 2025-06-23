# Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingInfo
- [Back to Structron Documentation](./../_Structron.md)
- [Go to ShippingInfo.php](./../../src/Dto/GetShippingCost/ShippingInfo.php)

Holds the shipping information for a product or products.

| ShippingInfo   | Type           | Default  | Description |
| -------------- | -------------- | -------- | ----------- |
| productIds     | int[]          | required |             |
| itemsCount     | int            | required |             |
| itemsWeight    | float          | required |             |
| itemsPrice     | float          | required |             |
| countryIsoEnum | CountryIsoEnum | null     |             |
| shippingGroup  | string         | null     |             |
| PostalCode     | string         | null     |             |
