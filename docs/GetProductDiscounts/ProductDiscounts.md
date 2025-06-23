# Wundii\AfterbuySdk\Dto\GetProductDiscounts\ProductDiscounts
- [Back to Structron Documentation](./../_Structron.md)
- [Go to ProductDiscounts.php](./../../src/Dto/GetProductDiscounts/ProductDiscounts.php)

Holds a list of product discounts.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetProductDiscounts\ProductDiscount | ProductDiscount |

## Properties
| ProductDiscounts                                     | Type              | Default  | Description |
| ---------------------------------------------------- | ----------------- | -------- | ----------- |
| **productDiscounts**                                 | ProductDiscount[] | []       |             |
| &nbsp; productDiscounts.productId                    | int               | required |             |
| &nbsp; productDiscounts.controlId                    | int               | required |             |
| &nbsp; productDiscounts.amountDiscount               | float             | null     |             |
| &nbsp; productDiscounts.percentDiscount              | float             | null     |             |
| &nbsp; productDiscounts.startDate                    | DateTimeInterface | null     |             |
| &nbsp; productDiscounts.endDate                      | DateTimeInterface | null     |             |
| &nbsp; productDiscounts.itemLastUserModificationDate | DateTimeInterface | null     |             |
| &nbsp; productDiscounts.priceType                    | string            | null     |             |
| &nbsp; productDiscounts.newPriceType                 | string            | null     |             |
| &nbsp; productDiscounts.timeLeftInMinutes            | int               | null     |             |
