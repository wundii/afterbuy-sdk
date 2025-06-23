# Wundii\AfterbuySdk\Dto\GetStockInfo\Products
- [Back to Structron Documentation](./../_Structron.md)
- [Go to Products.php](./../../src/Dto/GetStockInfo/Products.php)

Holds a list of payment services.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetStockInfo\Product | Product |

## Properties
| Products                     | Type      | Default  | Description |
| ---------------------------- | --------- | -------- | ----------- |
| **products**                 | Product[] | []       |             |
| products.productId           | int       | required |             |
| products.name                | string    | null     |             |
| products.anr                 | int       | null     |             |
| products.ean                 | string    | null     |             |
| products.auctionQuantity     | int       | null     |             |
| products.quantity            | int       | null     |             |
| products.fullFilmentQuantity | int       | null     |             |
| products.minimumStock        | int       | null     |             |
| products.discontinued        | bool      | false    |             |
| products.mergeStock          | bool      | false    |             |
| products.availableShop       | int       | null     |             |
| products.available           | bool      | false    |             |
| products.realQuantity        | int       | null     |             |
| products.level               | int       | null     |             |
