# Wundii\AfterbuySdk\Dto\GetSoldItems\SoldItems
- [Back to Structron Documentation](./../_Structron.md)
- [Go to SoldItems.php](./../../src/Dto/GetSoldItems/SoldItems.php)

Holds a list of sold items.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetSoldItems\BaseProductData | BaseProductData |
| Wundii\AfterbuySdk\Dto\GetSoldItems\ChildProduct | ChildProduct |
| Wundii\AfterbuySdk\Dto\GetSoldItems\ItemOriginalCurrency | ItemOriginalCurrency |
| Wundii\AfterbuySdk\Dto\GetSoldItems\ShopProductDetails | ShopProductDetails |
| Wundii\AfterbuySdk\Dto\GetSoldItems\SoldItem | SoldItem |
| Wundii\AfterbuySdk\Enum\BaseProductTypeEnum | BaseProductTypeEnum |
| Wundii\AfterbuySdk\Enum\FulfillmentServiceLevelEnum | FulfillmentServiceLevelEnum |
| Wundii\AfterbuySdk\Enum\InternalItemTypeEnum | InternalItemTypeEnum |
| Wundii\AfterbuySdk\Enum\ItemPlatFormNameEnum | ItemPlatFormNameEnum |
| Wundii\AfterbuySdk\Enum\ItemPriceCodeEnum | ItemPriceCodeEnum |
| Wundii\AfterbuySdk\Enum\TaxCollectedByEnum | TaxCollectedByEnum |

## Properties
| SoldItems                              | Type                        | Default                           | Description |
| -------------------------------------- | --------------------------- | --------------------------------- | ----------- |
| **soldItem**                           | SoldItem[]                  | []                                |             |
| soldItem.itemId                        | int                         | required                          |             |
| soldItem.itemDetailsDone               | bool                        | false                             |             |
| soldItem.anr                           | int                         | null                              |             |
| soldItem.isAmazonBusiness              | bool                        | false                             |             |
| soldItem.isAmazonPrime                 | bool                        | false                             |             |
| soldItem.isAmazonInvoiced              | bool                        | false                             |             |
| soldItem.isExternalInvoice             | bool                        | false                             |             |
| soldItem.fulfillmentServiceLevelEnum   | FulfillmentServiceLevelEnum | FulfillmentServiceLevelEnum::NONE |             |
| soldItem.platformSpecificOrderId       | string                      | null                              |             |
| soldItem.ebayTransactionId             | int                         | null                              |             |
| soldItem.eBayPlusTransaction           | bool                        | false                             |             |
| soldItem.alternativeItemNumber1        | string                      | null                              |             |
| soldItem.alternativeItemNumbe1         | string                      | null                              |             |
| soldItem.internalItemTypeEnum          | InternalItemTypeEnum        | null                              |             |
| soldItem.userDefinedFlag               | int                         | null                              |             |
| soldItem.itemTitle                     | string                      | null                              |             |
| soldItem.itemQuantity                  | int                         | null                              |             |
| soldItem.itemPrice                     | float                       | null                              |             |
| soldItem.itemEndDate                   | DateTimeInterface           | null                              |             |
| soldItem.taxRate                       | float                       | null                              |             |
| soldItem.taxCollectedByEnum            | TaxCollectedByEnum          | null                              |             |
| soldItem.platformTaxReference          | string                      | null                              |             |
| soldItem.itemWeight                    | float                       | null                              |             |
| soldItem.itemXmlDate                   | DateTimeInterface           | null                              |             |
| soldItem.itemModDate                   | DateTimeInterface           | null                              |             |
| soldItem.itemPlatFormNameEnum          | ItemPlatFormNameEnum        | null                              |             |
| soldItem.itemLink                      | string                      | null                              |             |
| soldItem.ebayFeedbackCompleted         | bool                        | null                              |             |
| soldItem.ebayFeedbackReceived          | bool                        | null                              |             |
| soldItem.ebayFeedbackCommentType       | string                      | null                              |             |
| **soldItem.itemOriginalCurrency**      | ItemOriginalCurrency        | null                              |             |
| itemOriginalCurrency.itemPrice         | float                       | null                              |             |
| itemOriginalCurrency.itemPriceCodeEnum | ItemPriceCodeEnum           | null                              |             |
| itemOriginalCurrency.itemShipping      | float                       | null                              |             |
| **soldItem.shopProductDetails**        | ShopProductDetails          | null                              |             |
| shopProductDetails.productId           | int                         | null                              |             |
| shopProductDetails.anr                 | int                         | null                              |             |
| shopProductDetails.ean                 | string                      | null                              |             |
| shopProductDetails.unitOfQuantity      | string                      | null                              |             |
| shopProductDetails.basepriceFactor     | float                       | null                              |             |
| **shopProductDetails.baseProductData** | BaseProductData             | null                              |             |
| baseProductData.baseProductTypeEnum    | BaseProductTypeEnum         | required                          |             |
| **baseProductData.childProduct**       | ChildProduct[]              | []                                |             |
| childProduct.productId                 | int                         | null                              |             |
| childProduct.productAnr                | int                         | null                              |             |
| childProduct.productEan                | string                      | null                              |             |
| childProduct.productName               | string                      | null                              |             |
| childProduct.productQuantity           | int                         | 0                                 |             |
| childProduct.productVat                | float                       | 0                                 |             |
| childProduct.productWeight             | float                       | 0                                 |             |
| childProduct.productUnitPrice          | float                       | 0                                 |             |
| childProduct.stockLocation1            | string                      | null                              |             |
| childProduct.stockLocation2            | string                      | null                              |             |
| childProduct.stockLocation3            | string                      | null                              |             |
| shopProductDetails.stockLocation1      | string                      | null                              |             |
| shopProductDetails.stockLocation2      | string                      | null                              |             |
| shopProductDetails.stockLocation3      | string                      | null                              |             |
| itemsInOrder                           | int                         | null                              |             |
