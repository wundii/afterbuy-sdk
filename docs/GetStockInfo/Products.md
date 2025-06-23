# Wundii\AfterbuySdk\Dto\GetStockInfo\Products
- [Back to Structron Documentation](/var/www/afterbuy-sdk/docs//_Structron.md)
- [Go to Products.php](/var/www/afterbuy-sdk/src/Dto/GetStockInfo/Products.php)

Holds a list of payment services.

| Products                            | Type                                          | Default  | Description |
| ----------------------------------- | --------------------------------------------- | -------- | ----------- |
| **products**                        | Wundii\AfterbuySdk\Dto\GetStockInfo\Product[] | []       |             |
| &nbsp; products.productId           | int                                           | required |             |
| &nbsp; products.name                | string                                        | null     |             |
| &nbsp; products.anr                 | int                                           | null     |             |
| &nbsp; products.ean                 | string                                        | null     |             |
| &nbsp; products.auctionQuantity     | int                                           | null     |             |
| &nbsp; products.quantity            | int                                           | null     |             |
| &nbsp; products.fullFilmentQuantity | int                                           | null     |             |
| &nbsp; products.minimumStock        | int                                           | null     |             |
| &nbsp; products.discontinued        | bool                                          | false    |             |
| &nbsp; products.mergeStock          | bool                                          | false    |             |
| &nbsp; products.availableShop       | int                                           | null     |             |
| &nbsp; products.available           | bool                                          | false    |             |
| &nbsp; products.realQuantity        | int                                           | null     |             |
| &nbsp; products.level               | int                                           | null     |             |
