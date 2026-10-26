# Wundii\AfterbuySdk\Dto\UpdateSoldItems\Orders
- [Back to Structron Documentation](./../_Structron.md)
- [Go to Orders.php](./../../src/Dto/UpdateSoldItems/Orders.php)

Holds a list of orders to update.

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
| Orders                             | Type              | Default  | Description                                                                                                                                     |
| ---------------------------------- | ----------------- | -------- | ----------------------------------------------------------------------------------------------------------------------------------------------- |
| **orders**                         | Order[]           | []       |                                                                                                                                                 |
| orders.orderId                     | int               | null     |                                                                                                                                                 |
| orders.itemId                      | int               | null     |                                                                                                                                                 |
| orders.userDefindedFlag            | int               | null     |                                                                                                                                                 |
| orders.productId                   | int               | null     | Re-assigns the linked product; only works for single-item orders and is not recommended by Afterbuy                                             |
| orders.additionalInfo              | string            | null     | Overwritten by parcel label data if present; do not use it for tracking numbers (use ShippingInfo parcelLabels)                                 |
| orders.mailDate                    | DateTimeInterface | null     |                                                                                                                                                 |
| orders.reminderMailDate            | DateTimeInterface | null     |                                                                                                                                                 |
| orders.userComment                 | string            | null     |                                                                                                                                                 |
| orders.orderMemo                   | string            | null     |                                                                                                                                                 |
| orders.invoiceMemo                 | string            | null     |                                                                                                                                                 |
| orders.orderExported               | bool              | null     |                                                                                                                                                 |
| orders.invoiceDate                 | DateTimeInterface | null     |                                                                                                                                                 |
| orders.invoiceNumber               | int               | null     |                                                                                                                                                 |
| orders.hideOrder                   | bool              | null     |                                                                                                                                                 |
| orders.reminder1Date               | DateTimeInterface | null     |                                                                                                                                                 |
| orders.reminder2Date               | DateTimeInterface | null     |                                                                                                                                                 |
| orders.feedbackDate                | DateTimeInterface | null     |                                                                                                                                                 |
| orders.xmlDate                     | DateTimeInterface | null     |                                                                                                                                                 |
| **orders.buyerInfo**               | BuyerInfo         | null     |                                                                                                                                                 |
| **buyerInfo.shippingAddress**      | ShippingAddress   | required |                                                                                                                                                 |
| shippingAddress.useShippingAddress | bool              | null     |                                                                                                                                                 |
| shippingAddress.firstName          | string            | null     |                                                                                                                                                 |
| shippingAddress.lastName           | string            | null     |                                                                                                                                                 |
| shippingAddress.company            | string            | null     |                                                                                                                                                 |
| shippingAddress.street             | string            | null     |                                                                                                                                                 |
| shippingAddress.street2            | string            | null     |                                                                                                                                                 |
| shippingAddress.stateOrProvince    | string            | null     |                                                                                                                                                 |
| shippingAddress.phone              | string            | null     |                                                                                                                                                 |
| shippingAddress.postalCode         | string            | null     |                                                                                                                                                 |
| shippingAddress.city               | string            | null     |                                                                                                                                                 |
| shippingAddress.country            | string            | null     |                                                                                                                                                 |
| shippingAddress.countryIsoEnum     | CountryIsoEnum    | null     |                                                                                                                                                 |
| **orders.paymentInfo**             | PaymentInfo       | null     |                                                                                                                                                 |
| paymentInfo.paymentMethod          | string            | null     |                                                                                                                                                 |
| paymentInfo.paymentDate            | DateTimeInterface | null     |                                                                                                                                                 |
| paymentInfo.paymentTransactionId   | string            | null     |                                                                                                                                                 |
| paymentInfo.alreadyPaid            | float             | null     |                                                                                                                                                 |
| paymentInfo.paymentAdditionalCost  | float             | null     |                                                                                                                                                 |
| paymentInfo.sendPaymentMail        | bool              | null     | If true, Afterbuy sends the payment confirmation email to the buyer                                                                             |
| **orders.shippingInfo**            | ShippingInfo      | null     |                                                                                                                                                 |
| shippingInfo.shippingMethod        | string            | null     |                                                                                                                                                 |
| shippingInfo.shippingReturnMethod  | string            | null     |                                                                                                                                                 |
| shippingInfo.shippingGroup         | string            | null     |                                                                                                                                                 |
| shippingInfo.shippingCost          | float             | null     |                                                                                                                                                 |
| shippingInfo.deliveryDate          | DateTimeInterface | null     |                                                                                                                                                 |
| shippingInfo.deliveryService       | string            | null     |                                                                                                                                                 |
| shippingInfo.ebayShippingCost      | float             | null     |                                                                                                                                                 |
| shippingInfo.sendShippingMail      | bool              | null     | If true, Afterbuy sends the dispatch email to the buyer                                                                                         |
| **shippingInfo.parcelLabels**      | ParcelLabel[]     | []       | Replaces all parcel labels of the order: always send the complete set (read it via GetSoldItems first), labels left out are deleted permanently |
| parcelLabels.itemId                | int               | required |                                                                                                                                                 |
| parcelLabels.packageNumber         | int               | required | Package number 1-15; the numbers must form a consecutive sequence across all items of the order                                                 |
| parcelLabels.parcelLabelNumber     | string            | null     | Tracking number of the package; an existing number is deleted if this is empty or null                                                          |
| parcelLabels.returnLabelNumber     | string            | null     | Return label number of the package; an existing number is deleted if this is empty or null                                                      |
| parcelLabels.packageQuantity       | int               | null     |                                                                                                                                                 |
| parcelLabels.packageWeight         | float             | null     |                                                                                                                                                 |
| **orders.vorgangsInfo**            | VorgangsInfo      | null     |                                                                                                                                                 |
| vorgangsInfo.VorgangsInfo1         | string            | null     | Overwrites the existing value; an empty string removes it, null leaves it unchanged                                                             |
| vorgangsInfo.VorgangsInfo2         | string            | null     | Overwrites the existing value; an empty string removes it, null leaves it unchanged                                                             |
| vorgangsInfo.VorgangsInfo3         | string            | null     | Overwrites the existing value; an empty string removes it, null leaves it unchanged                                                             |
| orders.tags                        | string[]          | []       | Tags must already exist in Afterbuy; no new tags are created                                                                                    |
| orders.attributes                  | Attribute         | []       |                                                                                                                                                 |
