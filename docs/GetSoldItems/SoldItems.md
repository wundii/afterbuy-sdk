# Wundii\AfterbuySdk\Dto\GetSoldItems\SoldItems
- [Back to Structron Documentation](./../_Structron.md)
- [Go to SoldItems.php](./../../src/Dto/GetSoldItems/SoldItems.php)

Holds a list of sold items.

| SoldItems                                                 | Type                        | Default                           | Description |
| --------------------------------------------------------- | --------------------------- | --------------------------------- | ----------- |
| **soldItem**                                              | SoldItem[]                  | []                                |             |
| &nbsp; soldItem.itemId                                    | int                         | required                          |             |
| &nbsp; soldItem.itemDetailsDone                           | bool                        | false                             |             |
| &nbsp; soldItem.anr                                       | int                         | null                              |             |
| &nbsp; soldItem.isAmazonBusiness                          | bool                        | false                             |             |
| &nbsp; soldItem.isAmazonPrime                             | bool                        | false                             |             |
| &nbsp; soldItem.isAmazonInvoiced                          | bool                        | false                             |             |
| &nbsp; soldItem.isExternalInvoice                         | bool                        | false                             |             |
| &nbsp; soldItem.fulfillmentServiceLevelEnum               | FulfillmentServiceLevelEnum | FulfillmentServiceLevelEnum::NONE |             |
| &nbsp; soldItem.platformSpecificOrderId                   | string                      | null                              |             |
| &nbsp; soldItem.ebayTransactionId                         | int                         | null                              |             |
| &nbsp; soldItem.eBayPlusTransaction                       | bool                        | false                             |             |
| &nbsp; soldItem.alternativeItemNumber1                    | string                      | null                              |             |
| &nbsp; soldItem.alternativeItemNumbe1                     | string                      | null                              |             |
| &nbsp; soldItem.internalItemTypeEnum                      | InternalItemTypeEnum        | null                              |             |
| &nbsp; soldItem.userDefinedFlag                           | int                         | null                              |             |
| &nbsp; soldItem.itemTitle                                 | string                      | null                              |             |
| &nbsp; soldItem.itemQuantity                              | int                         | null                              |             |
| &nbsp; soldItem.itemPrice                                 | float                       | null                              |             |
| &nbsp; soldItem.itemEndDate                               | DateTimeInterface           | null                              |             |
| &nbsp; soldItem.taxRate                                   | float                       | null                              |             |
| &nbsp; soldItem.taxCollectedByEnum                        | TaxCollectedByEnum          | null                              |             |
| &nbsp; soldItem.platformTaxReference                      | string                      | null                              |             |
| &nbsp; soldItem.itemWeight                                | float                       | null                              |             |
| &nbsp; soldItem.itemXmlDate                               | DateTimeInterface           | null                              |             |
| &nbsp; soldItem.itemModDate                               | DateTimeInterface           | null                              |             |
| &nbsp; soldItem.itemPlatFormNameEnum                      | ItemPlatFormNameEnum        | null                              |             |
| &nbsp; soldItem.itemLink                                  | string                      | null                              |             |
| &nbsp; soldItem.ebayFeedbackCompleted                     | bool                        | null                              |             |
| &nbsp; soldItem.ebayFeedbackReceived                      | bool                        | null                              |             |
| &nbsp; soldItem.ebayFeedbackCommentType                   | string                      | null                              |             |
| **&nbsp; soldItem.itemOriginalCurrency**                  | ItemOriginalCurrency        | null                              |             |
| &nbsp; &nbsp; itemOriginalCurrency.itemPrice              | float                       | null                              |             |
| &nbsp; &nbsp; itemOriginalCurrency.itemPriceCodeEnum      | ItemPriceCodeEnum           | null                              |             |
| &nbsp; &nbsp; itemOriginalCurrency.itemShipping           | float                       | null                              |             |
| **&nbsp; soldItem.shopProductDetails**                    | ShopProductDetails          | null                              |             |
| &nbsp; &nbsp; shopProductDetails.productId                | int                         | null                              |             |
| &nbsp; &nbsp; shopProductDetails.anr                      | int                         | null                              |             |
| &nbsp; &nbsp; shopProductDetails.ean                      | string                      | null                              |             |
| &nbsp; &nbsp; shopProductDetails.unitOfQuantity           | string                      | null                              |             |
| &nbsp; &nbsp; shopProductDetails.basepriceFactor          | float                       | null                              |             |
| **&nbsp; &nbsp; shopProductDetails.baseProductData**      | BaseProductData             | null                              |             |
| &nbsp; &nbsp; &nbsp; baseProductData.baseProductTypeEnum  | BaseProductTypeEnum         | required                          |             |
| **&nbsp; &nbsp; &nbsp; baseProductData.childProduct**     | ChildProduct[]              | []                                |             |
| &nbsp; &nbsp; &nbsp; &nbsp; childProduct.productId        | int                         | null                              |             |
| &nbsp; &nbsp; &nbsp; &nbsp; childProduct.productAnr       | int                         | null                              |             |
| &nbsp; &nbsp; &nbsp; &nbsp; childProduct.productEan       | string                      | null                              |             |
| &nbsp; &nbsp; &nbsp; &nbsp; childProduct.productName      | string                      | null                              |             |
| &nbsp; &nbsp; &nbsp; &nbsp; childProduct.productQuantity  | int                         | 0                                 |             |
| &nbsp; &nbsp; &nbsp; &nbsp; childProduct.productVat       | float                       | 0                                 |             |
| &nbsp; &nbsp; &nbsp; &nbsp; childProduct.productWeight    | float                       | 0                                 |             |
| &nbsp; &nbsp; &nbsp; &nbsp; childProduct.productUnitPrice | float                       | 0                                 |             |
| &nbsp; &nbsp; &nbsp; &nbsp; childProduct.stockLocation1   | string                      | null                              |             |
| &nbsp; &nbsp; &nbsp; &nbsp; childProduct.stockLocation2   | string                      | null                              |             |
| &nbsp; &nbsp; &nbsp; &nbsp; childProduct.stockLocation3   | string                      | null                              |             |
| &nbsp; &nbsp; shopProductDetails.stockLocation1           | string                      | null                              |             |
| &nbsp; &nbsp; shopProductDetails.stockLocation2           | string                      | null                              |             |
| &nbsp; &nbsp; shopProductDetails.stockLocation3           | string                      | null                              |             |
| itemsInOrder                                              | int                         | null                              |             |
