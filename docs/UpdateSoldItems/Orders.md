# Wundii\AfterbuySdk\Dto\UpdateSoldItems\Orders
- [Back to Structron Documentation](/var/www/afterbuy-sdk/docs//_Structron.md)
- [Go to Orders.php](/var/www/afterbuy-sdk/src/Dto/UpdateSoldItems/Orders.php)

Holds a list of payment services.

| Orders                                                  | Type                                                   | Default  | Description |
| ------------------------------------------------------- | ------------------------------------------------------ | -------- | ----------- |
| **orders**                                              | Wundii\AfterbuySdk\Dto\UpdateSoldItems\Order[]         | []       |             |
| &nbsp; orders.orderId                                   | int                                                    | null     |             |
| &nbsp; orders.itemId                                    | int                                                    | null     |             |
| &nbsp; orders.userDefindedFlag                          | int                                                    | null     |             |
| &nbsp; orders.productId                                 | int                                                    | null     |             |
| &nbsp; orders.additionalInfo                            | string                                                 | null     |             |
| &nbsp; orders.mailDate                                  | DateTimeInterface                                      | null     |             |
| &nbsp; orders.reminderMailDate                          | DateTimeInterface                                      | null     |             |
| &nbsp; orders.userComment                               | string                                                 | null     |             |
| &nbsp; orders.orderMemo                                 | string                                                 | null     |             |
| &nbsp; orders.invoiceMemo                               | string                                                 | null     |             |
| &nbsp; orders.orderExported                             | bool                                                   | null     |             |
| &nbsp; orders.invoiceDate                               | DateTimeInterface                                      | null     |             |
| &nbsp; orders.invoiceNumber                             | int                                                    | null     |             |
| &nbsp; orders.hideOrder                                 | bool                                                   | null     |             |
| &nbsp; orders.reminder1Date                             | DateTimeInterface                                      | null     |             |
| &nbsp; orders.reminder2Date                             | DateTimeInterface                                      | null     |             |
| &nbsp; orders.feedbackDate                              | DateTimeInterface                                      | null     |             |
| &nbsp; orders.xmlDate                                   | DateTimeInterface                                      | null     |             |
| **&nbsp; orders.buyerInfo**                             | Wundii\AfterbuySdk\Dto\UpdateSoldItems\BuyerInfo       | null     |             |
| **&nbsp; &nbsp; buyerInfo.shippingAddress**             | Wundii\AfterbuySdk\Dto\UpdateSoldItems\ShippingAddress | required |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.useShippingAddress | bool                                                   | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.firstName          | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.lastName           | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.company            | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.street             | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.street2            | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.stateOrProvince    | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.phone              | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.postalCode         | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.city               | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.country            | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; shippingAddress.countryIsoEnum     | Wundii\AfterbuySdk\Enum\CountryIsoEnum                 | null     |             |
| **&nbsp; orders.paymentInfo**                           | Wundii\AfterbuySdk\Dto\UpdateSoldItems\PaymentInfo     | null     |             |
| &nbsp; &nbsp; paymentInfo.paymentMethod                 | string                                                 | null     |             |
| &nbsp; &nbsp; paymentInfo.paymentDate                   | DateTimeInterface                                      | null     |             |
| &nbsp; &nbsp; paymentInfo.paymentTransactionId          | string                                                 | null     |             |
| &nbsp; &nbsp; paymentInfo.alreadyPaid                   | float                                                  | null     |             |
| &nbsp; &nbsp; paymentInfo.paymentAdditionalCost         | float                                                  | null     |             |
| &nbsp; &nbsp; paymentInfo.sendPaymentMail               | float                                                  | null     |             |
| **&nbsp; orders.shippingInfo**                          | Wundii\AfterbuySdk\Dto\UpdateSoldItems\ShippingInfo    | null     |             |
| &nbsp; &nbsp; shippingInfo.shippingMethod               | string                                                 | null     |             |
| &nbsp; &nbsp; shippingInfo.shippingReturnMethod         | string                                                 | null     |             |
| &nbsp; &nbsp; shippingInfo.shippingGroup                | string                                                 | null     |             |
| &nbsp; &nbsp; shippingInfo.shippingCost                 | float                                                  | null     |             |
| &nbsp; &nbsp; shippingInfo.deliveryDate                 | DateTimeInterface                                      | null     |             |
| &nbsp; &nbsp; shippingInfo.deliveryService              | string                                                 | null     |             |
| &nbsp; &nbsp; shippingInfo.ebayShippingCost             | float                                                  | null     |             |
| &nbsp; &nbsp; shippingInfo.sendShippingMail             | bool                                                   | null     |             |
| **&nbsp; &nbsp; shippingInfo.parcelLabels**             | Wundii\AfterbuySdk\Dto\UpdateSoldItems\ParcelLabel[]   | []       |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.itemId                | int                                                    | required |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.packageNumber         | int                                                    | required |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.parcelLabelNumber     | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.returnLabelNumber     | string                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.packageQuantity       | int                                                    | null     |             |
| &nbsp; &nbsp; &nbsp; parcelLabels.packageWeight         | float                                                  | null     |             |
| **&nbsp; orders.vorgangsInfo**                          | Wundii\AfterbuySdk\Dto\UpdateSoldItems\VorgangsInfo    | null     |             |
| &nbsp; &nbsp; vorgangsInfo.VorgangsInfo1                | string                                                 | null     |             |
| &nbsp; &nbsp; vorgangsInfo.VorgangsInfo2                | string                                                 | null     |             |
| &nbsp; &nbsp; vorgangsInfo.VorgangsInfo3                | string                                                 | null     |             |
| &nbsp; orders.tags                                      | string[]                                               | []       |             |
| &nbsp; orders.attributes                                | Attribute                                              | []       |             |
