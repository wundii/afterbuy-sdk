# Wundii\AfterbuySdk\Dto\GetPaymentServices\PaymentServices
- [Back to Structron Documentation](./../_Structron.md)
- [Go to PaymentServices.php](./../../src/Dto/GetPaymentServices/PaymentServices.php)

Holds a list of payment services.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetPaymentServices\PaymentService | PaymentService |

## Properties
| PaymentServices                      | Type             | Default  | Description |
| ------------------------------------ | ---------------- | -------- | ----------- |
| **paymentService**                   | PaymentService[] | required |             |
| paymentService.paymentId             | int              | required |             |
| paymentService.paymentFunctionId     | int              | required |             |
| paymentService.name                  | string           | required |             |
| paymentService.standardText          | string           | null     |             |
| paymentService.position              | int              | 0        |             |
| paymentService.level                 | int              | 0        |             |
| paymentService.surcharge             | float            | 0        |             |
| paymentService.surchargePercent      | float            | 0        |             |
| paymentService.minAmount             | float            | 0        |             |
| paymentService.maxAmount             | float            | 0        |             |
| paymentService.plattformName         | string           | null     |             |
| paymentService.standardForAll        | bool             | false    |             |
| paymentService.default               | bool             | false    |             |
| paymentService.countryGroup          | string           | null     |             |
| paymentService.countryGroupCountries | string           | null     |             |
