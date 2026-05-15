# Wundii\AfterbuySdk\Dto\CancelOrders\OrderCancellations
- [Back to Structron Documentation](./../_Structron.md)
- [Go to OrderCancellations.php](./../../src/Dto/CancelOrders/OrderCancellations.php)

Holds a list of order cancellations.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\CancelOrders\OrderCancellation | OrderCancellation |
| Wundii\AfterbuySdk\Enum\StockBookingEnum | StockBookingEnum |

## Properties
| OrderCancellations                  | Type                | Default  | Description |
| ----------------------------------- | ------------------- | -------- | ----------- |
| **orderCancellations**              | OrderCancellation[] | []       |             |
| orderCancellations.orderId          | int                 | required |             |
| orderCancellations.stockBookingEnum | StockBookingEnum    | null     |             |
| orderCancellations.hideOrder        | bool                | null     |             |
| orderCancellations.markId           | int                 | null     |             |
