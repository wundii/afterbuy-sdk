# Wundii\AfterbuySdk\Dto\UpdateSoldItems\Orders
- [Back to Structron Documentation](./../_Structron.md)
- [Go to Orders.php](./../../src/Dto/UpdateSoldItems/Orders.php)

Holds a list of payment services.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\Order | Order |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\BuyerInfo | BuyerInfo |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\ShippingAddress | ShippingAddress |
| Wundii\AfterbuySdk\Enum\CountryIsoEnum | CountryIsoEnum |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\PaymentInfo | PaymentInfo |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\ShippingInfo | ShippingInfo |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\ParcelLabel | ParcelLabel |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\VorgangsInfo | VorgangsInfo |

## Properties
| Orders                                                  | Type              | Default  | Description |
| ------------------------------------------------------- | ----------------- | -------- | ----------- |
| **orders**                                              | Order[]           | []       |             |
| &nbsp; orders.orderId                                   | int               | null     |             |
| &nbsp; orders.itemId                                    | int               | null     |             |
| &nbsp; orders.userDefindedFlag                          | int               | null     |             |
| &nbsp; orders.productId                                 | int               | null     |             |
| &nbsp; orders.additionalInfo                            | string            | null     |             |
| &nbsp; orders.mailDate                                  | DateTimeInterface | null     |             |
| &nbsp; orders.reminderMailDate                          | DateTimeInterface | null     |             |
| &nbsp; orders.userComment                               | string            | null     |             |
| &nbsp; orders.orderMemo                                 | string            | null     |             |
| &nbsp; orders.invoiceMemo                               | string            | null     |             |
| &nbsp; orders.orderExported                             | bool              | null     |             |
| &nbsp; orders.invoiceDate                               | DateTimeInterface | null     |             |
| &nbsp; orders.invoiceNumber                             | int               | null     |             |
| &nbsp; orders.hideOrder                                 | bool              | null     |             |
| &nbsp; orders.reminder1Date                             | DateTimeInterface | null     |             |
| &nbsp; orders.reminder2Date                             | DateTimeInterface | null     |             |
| &nbsp; orders.feedbackDate                              | DateTimeInterface | null     |             |
| &nbsp; orders.xmlDate                                   | DateTimeInterface | null     |             |
| **&nbsp; orders.buyerInfo**                             | BuyerInfo         | null     |             |
| **&nbsp; &nbsp; buyerInfo.shippingAddress**             | ShippingAddress   | required |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.useShippingAddress | bool              | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.firstName          | string            | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.lastName           | string            | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.company            | string            | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.street             | string            | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.street2            | string            | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.stateOrProvince    | string            | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.phone              | string            | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.postalCode         | string            | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.city               | string            | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.country            | string            | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.countryIsoEnum     | CountryIsoEnum    | null     |             |
| **&nbsp; orders.paymentInfo**                           | PaymentInfo       | null     |             |
| &nbsp; &nbsp; paymentInfo.paymentMethod                 | string            | null     |             |
| &nbsp; &nbsp; paymentInfo.paymentDate                   | DateTimeInterface | null     |             |
| &nbsp; &nbsp; paymentInfo.paymentTransactionId          | string            | null     |             |
| &nbsp; &nbsp; paymentInfo.alreadyPaid                   | float             | null     |             |
| &nbsp; &nbsp; paymentInfo.paymentAdditionalCost         | float             | null     |             |
| &nbsp; &nbsp; paymentInfo.sendPaymentMail               | float             | null     |             |
| **&nbsp; orders.shippingInfo**                          | ShippingInfo      | null     |             |
| &nbsp; &nbsp; shippingInfo.shippingMethod               | string            | null     |             |
| &nbsp; &nbsp; shippingInfo.shippingReturnMethod         | string            | null     |             |
| &nbsp; &nbsp; shippingInfo.shippingGroup                | string            | null     |             |
| &nbsp; &nbsp; shippingInfo.shippingCost                 | float             | null     |             |
| &nbsp; &nbsp; shippingInfo.deliveryDate                 | DateTimeInterface | null     |             |
| &nbsp; &nbsp; shippingInfo.deliveryService              | string            | null     |             |
| &nbsp; &nbsp; shippingInfo.ebayShippingCost             | float             | null     |             |
| &nbsp; &nbsp; shippingInfo.sendShippingMail             | bool              | null     |             |
| **&nbsp; &nbsp; shippingInfo.parcelLabels**             | ParcelLabel[]     | []       |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.itemId                | int               | required |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.packageNumber         | int               | required |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.parcelLabelNumber     | string            | null     |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.returnLabelNumber     | string            | null     |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.packageQuantity       | int               | null     |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.packageWeight         | float             | null     |             |
| **&nbsp; orders.vorgangsInfo**                          | VorgangsInfo      | null     |             |
| &nbsp; &nbsp; vorgangsInfo.VorgangsInfo1                | string            | null     |             |
| &nbsp; &nbsp; vorgangsInfo.VorgangsInfo2                | string            | null     |             |
| &nbsp; &nbsp; vorgangsInfo.VorgangsInfo3                | string            | null     |             |
| &nbsp; orders.tags                                      | string[]          | []       |             |
| &nbsp; orders.attributes                                | Attribute         | []       |             |
