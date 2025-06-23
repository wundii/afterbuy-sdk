# Wundii\AfterbuySdk\Dto\GetPaymentServices\PaymentServices
- [Back to Structron Documentation](./../_Structron.md)
- [Go to PaymentServices.php](./../../src/Dto/GetPaymentServices/PaymentServices.php)

Holds a list of payment services.

| PaymentServices                             | Type             | Default  | Description |
| ------------------------------------------- | ---------------- | -------- | ----------- |
| **paymentService**                          | PaymentService[] | required |             |
| &nbsp; paymentService.paymentId             | int              | required |             |
| &nbsp; paymentService.paymentFunctionId     | int              | required |             |
| &nbsp; paymentService.name                  | string           | required |             |
| &nbsp; paymentService.standardText          | string           | null     |             |
| &nbsp; paymentService.position              | int              | 0        |             |
| &nbsp; paymentService.level                 | int              | 0        |             |
| &nbsp; paymentService.surcharge             | float            | 0        |             |
| &nbsp; paymentService.surchargePercent      | float            | 0        |             |
| &nbsp; paymentService.minAmount             | float            | 0        |             |
| &nbsp; paymentService.maxAmount             | float            | 0        |             |
| &nbsp; paymentService.plattformName         | string           | null     |             |
| &nbsp; paymentService.standardForAll        | bool             | false    |             |
| &nbsp; paymentService.default               | bool             | false    |             |
| &nbsp; paymentService.countryGroup          | string           | null     |             |
| &nbsp; paymentService.countryGroupCountries | string           | null     |             |
