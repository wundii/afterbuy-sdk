# Wundii\AfterbuySdk\Dto\GetProductDiscounts\ProductDiscounts
- [Back to Structron Documentation](./../_Structron.md)
- [Go to ProductDiscounts.php](./../../src/Dto/GetProductDiscounts/ProductDiscounts.php)

Holds a list of product discounts.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetProductDiscounts\ProductDiscount | ProductDiscount |

## Properties
| ProductDiscounts                              | Type              | Default  | Description                                                  |
| --------------------------------------------- | ----------------- | -------- | ------------------------------------------------------------ |
| **productDiscounts**                          | ProductDiscount[] | []       |                                                              |
| productDiscounts.productId                    | int               | required |                                                              |
| productDiscounts.controlId                    | int               | required | Type of promotion: 2 = LiveShopping, 3 = Discount            |
| productDiscounts.amountDiscount               | float             | null     | Discount as fixed amount; 0 if a percentage discount is used |
| productDiscounts.percentDiscount              | float             | null     | Discount in percent; 0 if a fixed amount discount is used    |
| productDiscounts.startDate                    | DateTimeInterface | null     |                                                              |
| productDiscounts.endDate                      | DateTimeInterface | null     |                                                              |
| productDiscounts.itemLastUserModificationDate | DateTimeInterface | null     |                                                              |
| productDiscounts.priceType                    | string            | null     |                                                              |
| productDiscounts.newPriceType                 | string            | null     |                                                              |
| productDiscounts.timeLeftInMinutes            | int               | null     |                                                              |
