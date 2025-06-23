# Wundii\AfterbuySdk\Dto\GetShopProducts\Products
- [Back to Structron Documentation](./../_Structron.md)
- [Go to Products.php](./../../src/Dto/GetShopProducts/Products.php)

Holds a list of payment services.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetShopProducts\AdditionalDescriptionField | AdditionalDescriptionField |
| Wundii\AfterbuySdk\Dto\GetShopProducts\AdditionalPrice | AdditionalPrice |
| Wundii\AfterbuySdk\Dto\GetShopProducts\Attribut | Attribut |
| Wundii\AfterbuySdk\Dto\GetShopProducts\BaseProduct | BaseProduct |
| Wundii\AfterbuySdk\Dto\GetShopProducts\BaseProductsRelationData | BaseProductsRelationData |
| Wundii\AfterbuySdk\Dto\GetShopProducts\EbayVariationData | EbayVariationData |
| Wundii\AfterbuySdk\Dto\GetShopProducts\EconomicOperator | EconomicOperator |
| Wundii\AfterbuySdk\Dto\GetShopProducts\Feature | Feature |
| Wundii\AfterbuySdk\Dto\GetShopProducts\PaginationResult | PaginationResult |
| Wundii\AfterbuySdk\Dto\GetShopProducts\PartsProperties | PartsProperties |
| Wundii\AfterbuySdk\Dto\GetShopProducts\PartsProperty | PartsProperty |
| Wundii\AfterbuySdk\Dto\GetShopProducts\Product | Product |
| Wundii\AfterbuySdk\Dto\GetShopProducts\ProductPicture | ProductPicture |
| Wundii\AfterbuySdk\Dto\GetShopProducts\ProductPictureChild | ProductPictureChild |
| Wundii\AfterbuySdk\Dto\GetShopProducts\ScaledDiscount | ScaledDiscount |
| Wundii\AfterbuySdk\Enum\AgeGroupEnum | AgeGroupEnum |
| Wundii\AfterbuySdk\Enum\BaseProductFlagEnum | BaseProductFlagEnum |
| Wundii\AfterbuySdk\Enum\ConditionEnum | ConditionEnum |
| Wundii\AfterbuySdk\Enum\CountryIsoEnum | CountryIsoEnum |
| Wundii\AfterbuySdk\Enum\CountryOfOriginEnum | CountryOfOriginEnum |
| Wundii\AfterbuySdk\Enum\EnergyClassEnum | EnergyClassEnum |
| Wundii\AfterbuySdk\Enum\GenderEnum | GenderEnum |
| Wundii\AfterbuySdk\Enum\PropertyNameEnum | PropertyNameEnum |

## Properties
| Products                                    | Type                         | Default                     | Description |
| ------------------------------------------- | ---------------------------- | --------------------------- | ----------- |
| hasMoreProducts                             | bool                         | false                       |             |
| lastProductId                               | int                          | null                        |             |
| **products**                                | Product[]                    | []                          |             |
| products.shop20Id                           | int                          | null                        |             |
| products.productId                          | int                          | null                        |             |
| products.anr                                | int                          | null                        |             |
| products.ean                                | string                       | null                        |             |
| products.name                               | string                       | null                        |             |
| products.seoName                            | string                       | null                        |             |
| products.modDate                            | DateTimeInterface            | null                        |             |
| products.variationName                      | string                       | null                        |             |
| products.baseProductFlagEnum                | BaseProductFlagEnum          | null                        |             |
| **products.baseProducts**                   | BaseProduct[]                | []                          |             |
| baseProducts.baseProductID                  | int                          | required                    |             |
| baseProducts.baseProductType                | int                          | required                    |             |
| **baseProducts.baseProductsRelationData**   | BaseProductsRelationData     | null                        |             |
| baseProductsRelationData.quantity           | int                          | required                    |             |
| baseProductsRelationData.variationLabel     | string                       | required                    |             |
| baseProductsRelationData.defaultProduct     | string                       | required                    |             |
| baseProductsRelationData.position           | int                          | required                    |             |
| **baseProductsRelationData.ebayVariationData** | EbayVariationData            | null                        |             |
| ebayVariationData.ebayVariationName         | string                       | required                    |             |
| ebayVariationData.ebayVariationValue        | string                       | required                    |             |
| products.shortDescription                   | string                       | null                        |             |
| products.tags                               | string[]                     | []                          |             |
| products.memo                               | string                       | null                        |             |
| products.googleBaseLabels                   | string                       | null                        |             |
| products.headerDescriptionName              | string                       | null                        |             |
| products.headerDescriptionValue             | string                       | null                        |             |
| products.description                        | string                       | null                        |             |
| products.footerDescriptionName              | string                       | null                        |             |
| products.footerDescriptionValue             | string                       | null                        |             |
| products.googleBaseShipping                 | string                       | null                        |             |
| products.keywords                           | string                       | null                        |             |
| products.quantity                           | int                          | null                        |             |
| products.availableShop                      | bool                         | false                       |             |
| products.auctionQuantity                    | int                          | null                        |             |
| products.stock                              | bool                         | false                       |             |
| products.discontinued                       | bool                         | false                       |             |
| products.mergeStock                         | bool                         | false                       |             |
| products.unitOfQuantity                     | string                       | null                        |             |
| products.basepriceFactor                    | int                          | null                        |             |
| products.minimumStock                       | int                          | null                        |             |
| products.minimumOrderQuantity               | int                          | null                        |             |
| products.fullFilmentQuantity                | int                          | null                        |             |
| products.fullFilmentImport                  | DateTimeInterface            | null                        |             |
| products.sellingPrice                       | float                        | null                        |             |
| products.buyingPrice                        | float                        | null                        |             |
| products.dealerPrice                        | float                        | null                        |             |
| products.level                              | int                          | null                        |             |
| products.position                           | int                          | null                        |             |
| products.titleReplace                       | bool                         | false                       |             |
| **products.scaledDiscounts**                | ScaledDiscount[]             | []                          |             |
| scaledDiscounts.scaledQuantity              | int                          | null                        |             |
| scaledDiscounts.scaledPrice                 | float                        | null                        |             |
| scaledDiscounts.scaledDPrice                | float                        | null                        |             |
| products.taxRate                            | float                        | null                        |             |
| products.weight                             | float                        | null                        |             |
| products.searchAlias                        | string                       | null                        |             |
| products.froogle                            | bool                         | false                       |             |
| products.kelkoo                             | bool                         | false                       |             |
| products.shippingGroup                      | string                       | null                        |             |
| products.shopShippingGroup                  | string                       | null                        |             |
| products.searchEngineShipping               | string                       | null                        |             |
| products.crossCatalogID                     | int                          | null                        |             |
| **products.features**                       | Feature[]                    | []                          |             |
| features.id                                 | int                          | required                    |             |
| features.name                               | string                       | required                    |             |
| features.value                              | string                       | required                    |             |
| products.freeValue1                         | string                       | null                        |             |
| products.freeValue2                         | string                       | null                        |             |
| products.freeValue3                         | string                       | null                        |             |
| products.freeValue4                         | string                       | null                        |             |
| products.freeValue5                         | string                       | null                        |             |
| products.freeValue6                         | string                       | null                        |             |
| products.freeValue7                         | string                       | null                        |             |
| products.freeValue8                         | string                       | null                        |             |
| products.freeValue9                         | string                       | null                        |             |
| products.freeValue10                        | string                       | null                        |             |
| products.deliveryTime                       | string                       | null                        |             |
| products.stocklocation_1                    | string                       | null                        |             |
| products.stocklocation_2                    | string                       | null                        |             |
| products.stocklocation_3                    | string                       | null                        |             |
| products.stocklocation_4                    | string                       | null                        |             |
| products.countryOfOriginEnum                | CountryOfOriginEnum          | null                        |             |
| products.lastSale                           | DateTimeInterface            | null                        |             |
| products.imageSmallURL                      | string                       | null                        |             |
| products.imageLargeURL                      | string                       | null                        |             |
| products.amazonStandardProductIdType        | string                       | null                        |             |
| products.amazonStandardProductIdValue       | string                       | null                        |             |
| products.manufacturerStandardProductIdType  | string                       | null                        |             |
| products.manufacturerStandardProductIdValue | string                       | null                        |             |
| products.productBrand                       | string                       | null                        |             |
| products.customsTariffNumber                | string                       | null                        |             |
| products.manufacturerPartNumber             | string                       | null                        |             |
| products.facebook                           | bool                         | false                       |             |
| products.googleProductCategory              | string                       | null                        |             |
| products.adwordsGrouping                    | string                       | null                        |             |
| products.conditionEnum                      | ConditionEnum                | ConditionEnum::NO_CONDITION |             |
| products.ageGroupEnum                       | AgeGroupEnum                 | null                        |             |
| products.genderEnum                         | GenderEnum                   | null                        |             |
| products.pattern                            | string                       | null                        |             |
| products.material                           | string                       | null                        |             |
| products.itemColor                          | string                       | null                        |             |
| products.itemSize                           | string                       | null                        |             |
| products.customLabel0                       | string                       | null                        |             |
| products.customLabel1                       | string                       | null                        |             |
| products.customLabel2                       | string                       | null                        |             |
| products.customLabel3                       | string                       | null                        |             |
| products.customLabel4                       | string                       | null                        |             |
| products.canonicalUrl                       | string                       | null                        |             |
| products.energyClassEnum                    | EnergyClassEnum              | EnergyClassEnum::NO_CLASS   |             |
| products.dataSheetUrl                       | string                       | null                        |             |
| products.skus                               | string[]                     | []                          |             |
| **products.productPictures**                | ProductPicture[]             | []                          |             |
| productPictures.nr                          | int                          | null                        |             |
| productPictures.typ                         | int                          | null                        |             |
| productPictures.url                         | string                       | null                        |             |
| productPictures.altText                     | string                       | null                        |             |
| **productPictures.childs**                  | ProductPictureChild[]        | []                          |             |
| childs.nr                                   | int                          | null                        |             |
| childs.typ                                  | int                          | null                        |             |
| childs.url                                  | string                       | null                        |             |
| childs.altText                              | string                       | null                        |             |
| products.catalogs                           | int[]                        | []                          |             |
| **products.attributes**                     | Attribut[]                   | []                          |             |
| attributes.attributName                     | string                       | null                        |             |
| attributes.attributWert                     | string                       | null                        |             |
| attributes.attributTyp                      | int                          | null                        |             |
| attributes.attributRequired                 | bool                         | false                       |             |
| **products.partsFitment**                   | PartsProperties[]            | []                          |             |
| **partsFitment.partsProperty**              | PartsProperty[]              | required                    |             |
| partsProperty.propertyNameEnum              | PropertyNameEnum             | required                    |             |
| partsProperty.propertyValue                 | string                       | required                    |             |
| **products.additionalDescriptionFields**    | AdditionalDescriptionField[] | []                          |             |
| additionalDescriptionFields.fieldId         | int                          | null                        |             |
| additionalDescriptionFields.fieldName       | string                       | null                        |             |
| additionalDescriptionFields.fieldLabel      | string                       | null                        |             |
| additionalDescriptionFields.fieldContent    | string                       | null                        |             |
| **products.additionalPrices**               | AdditionalPrice[]            | []                          |             |
| additionalPrices.definitionId               | int                          | null                        |             |
| additionalPrices.name                       | string                       | null                        |             |
| additionalPrices.value                      | float                        | null                        |             |
| additionalPrices.pretax                     | bool                         | null                        |             |
| **products.economicOperators**              | EconomicOperator[]           | []                          |             |
| economicOperators.company                   | string                       | null                        |             |
| economicOperators.street1                   | string                       | null                        |             |
| economicOperators.street2                   | string                       | null                        |             |
| economicOperators.postalCode                | string                       | null                        |             |
| economicOperators.city                      | string                       | null                        |             |
| economicOperators.stateOrProvince           | string                       | null                        |             |
| economicOperators.countryIsoEnum            | CountryIsoEnum               | null                        |             |
| economicOperators.email                     | string                       | null                        |             |
| economicOperators.phone                     | string                       | null                        |             |
| shippingServicesList                        | string                       | null                        |             |
| **paginationResult**                        | PaginationResult             | null                        |             |
| paginationResult.totalNumberOfEntries       | int                          | required                    |             |
| paginationResult.totalNumberOfPages         | int                          | required                    |             |
| paginationResult.itemsPerPage               | int                          | required                    |             |
| paginationResult.pageNumber                 | int                          | required                    |             |
