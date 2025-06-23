# Wundii\AfterbuySdk\Dto\GetProductDiscounts\ProductDiscounts
- [Back to Structron Documentation](./../_Structron.md)
- [Go to ProductDiscounts.php](./../../src/Dto/GetProductDiscounts/ProductDiscounts.php)

Holds a list of product discounts.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetProductDiscounts\ProductDiscount | ProductDiscount |

## Properties
| ProductDiscounts                              | Type              | Default  | Description |
| --------------------------------------------- | ----------------- | -------- | ----------- |
| **productDiscounts**                          | ProductDiscount[] | []       |             |
| productDiscounts.productId                    | int               | required |             |
| productDiscounts.controlId                    | int               | required |             |
| productDiscounts.amountDiscount               | float             | null     |             |
| productDiscounts.percentDiscount              | float             | null     |             |
| productDiscounts.startDate                    | DateTimeInterface | null     |             |
| productDiscounts.endDate                      | DateTimeInterface | null     |             |
| productDiscounts.itemLastUserModificationDate | DateTimeInterface | null     |             |
| productDiscounts.priceType                    | string            | null     |             |
| productDiscounts.newPriceType                 | string            | null     |             |
| productDiscounts.timeLeftInMinutes            | int               | null     |             |
