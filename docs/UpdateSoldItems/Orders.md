# Wundii\AfterbuySdk\Dto\UpdateSoldItems\Orders
- [Back to Structron Documentation](./../_Structron.md)
- [Go to Orders.php](./../../src/Dto/UpdateSoldItems/Orders.php)

Holds a list of payment services.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\BuyerInfo | BuyerInfo |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\Order | Order |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\ParcelLabel | ParcelLabel |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\PaymentInfo | PaymentInfo |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\ShippingAddress | ShippingAddress |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\ShippingInfo | ShippingInfo |
| Wundii\AfterbuySdk\Dto\UpdateSoldItems\VorgangsInfo | VorgangsInfo |
| Wundii\AfterbuySdk\Enum\CountryIsoEnum | CountryIsoEnum |

## Properties
| Orders                             | Type              | Default  | Description |
| ---------------------------------- | ----------------- | -------- | ----------- |
| **orders**                         | Order[]           | []       |             |
| orders.orderId                     | int               | null     |             |
| orders.itemId                      | int               | null     |             |
| orders.userDefindedFlag            | int               | null     |             |
| orders.productId                   | int               | null     |             |
| orders.additionalInfo              | string            | null     |             |
| orders.mailDate                    | DateTimeInterface | null     |             |
| orders.reminderMailDate            | DateTimeInterface | null     |             |
| orders.userComment                 | string            | null     |             |
| orders.orderMemo                   | string            | null     |             |
| orders.invoiceMemo                 | string            | null     |             |
| orders.orderExported               | bool              | null     |             |
| orders.invoiceDate                 | DateTimeInterface | null     |             |
| orders.invoiceNumber               | int               | null     |             |
| orders.hideOrder                   | bool              | null     |             |
| orders.reminder1Date               | DateTimeInterface | null     |             |
| orders.reminder2Date               | DateTimeInterface | null     |             |
| orders.feedbackDate                | DateTimeInterface | null     |             |
| orders.xmlDate                     | DateTimeInterface | null     |             |
| **orders.buyerInfo**               | BuyerInfo         | null     |             |
| **buyerInfo.shippingAddress**      | ShippingAddress   | required |             |
| shippingAddress.useShippingAddress | bool              | null     |             |
| shippingAddress.firstName          | string            | null     |             |
| shippingAddress.lastName           | string            | null     |             |
| shippingAddress.company            | string            | null     |             |
| shippingAddress.street             | string            | null     |             |
| shippingAddress.street2            | string            | null     |             |
| shippingAddress.stateOrProvince    | string            | null     |             |
| shippingAddress.phone              | string            | null     |             |
| shippingAddress.postalCode         | string            | null     |             |
| shippingAddress.city               | string            | null     |             |
| shippingAddress.country            | string            | null     |             |
| shippingAddress.countryIsoEnum     | CountryIsoEnum    | null     |             |
| **orders.paymentInfo**             | PaymentInfo       | null     |             |
| paymentInfo.paymentMethod          | string            | null     |             |
| paymentInfo.paymentDate            | DateTimeInterface | null     |             |
| paymentInfo.paymentTransactionId   | string            | null     |             |
| paymentInfo.alreadyPaid            | float             | null     |             |
| paymentInfo.paymentAdditionalCost  | float             | null     |             |
| paymentInfo.sendPaymentMail        | float             | null     |             |
| **orders.shippingInfo**            | ShippingInfo      | null     |             |
| shippingInfo.shippingMethod        | string            | null     |             |
| shippingInfo.shippingReturnMethod  | string            | null     |             |
| shippingInfo.shippingGroup         | string            | null     |             |
| shippingInfo.shippingCost          | float             | null     |             |
| shippingInfo.deliveryDate          | DateTimeInterface | null     |             |
| shippingInfo.deliveryService       | string            | null     |             |
| shippingInfo.ebayShippingCost      | float             | null     |             |
| shippingInfo.sendShippingMail      | bool              | null     |             |
| **shippingInfo.parcelLabels**      | ParcelLabel[]     | []       |             |
| parcelLabels.itemId                | int               | required |             |
| parcelLabels.packageNumber         | int               | required |             |
| parcelLabels.parcelLabelNumber     | string            | null     |             |
| parcelLabels.returnLabelNumber     | string            | null     |             |
| parcelLabels.packageQuantity       | int               | null     |             |
| parcelLabels.packageWeight         | float             | null     |             |
| **orders.vorgangsInfo**            | VorgangsInfo      | null     |             |
| vorgangsInfo.VorgangsInfo1         | string            | null     |             |
| vorgangsInfo.VorgangsInfo2         | string            | null     |             |
| vorgangsInfo.VorgangsInfo3         | string            | null     |             |
| orders.tags                        | string[]          | []       |             |
| orders.attributes                  | Attribute         | []       |             |
