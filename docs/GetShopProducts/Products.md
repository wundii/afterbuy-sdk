# Wundii\AfterbuySdk\Dto\GetShopProducts\Products
- [Back to Structron Documentation](/var/www/afterbuy-sdk/docs//_Structron.md)
- [Go to Products.php](/var/www/afterbuy-sdk/src/Dto/GetShopProducts/Products.php)

Holds a list of payment services.

| Products                                                         | Type                                                                | Default                     | Description |
| ---------------------------------------------------------------- | ------------------------------------------------------------------- | --------------------------- | ----------- |
| hasMoreProducts                                                  | bool                                                                | false                       |             |
| lastProductId                                                    | int                                                                 | null                        |             |
| **products**                                                     | Wundii\AfterbuySdk\Dto\GetShopProducts\Product[]                    | []                          |             |
| &nbsp; products.shop20Id                                         | int                                                                 | null                        |             |
| &nbsp; products.productId                                        | int                                                                 | null                        |             |
| &nbsp; products.anr                                              | int                                                                 | null                        |             |
| &nbsp; products.ean                                              | string                                                              | null                        |             |
| &nbsp; products.name                                             | string                                                              | null                        |             |
| &nbsp; products.seoName                                          | string                                                              | null                        |             |
| &nbsp; products.modDate                                          | DateTimeInterface                                                   | null                        |             |
| &nbsp; products.variationName                                    | string                                                              | null                        |             |
| &nbsp; products.baseProductFlagEnum                              | Wundii\AfterbuySdk\Enum\BaseProductFlagEnum                         | null                        |             |
| **&nbsp; products.baseProducts**                                 | Wundii\AfterbuySdk\Dto\GetShopProducts\BaseProduct[]                | []                          |             |
| &nbsp; &nbsp; baseProducts.baseProductID                         | int                                                                 | required                    |             |
| &nbsp; &nbsp; baseProducts.baseProductType                       | int                                                                 | required                    |             |
| **&nbsp; &nbsp; baseProducts.baseProductsRelationData**          | Wundii\AfterbuySdk\Dto\GetShopProducts\BaseProductsRelationData     | null                        |             |
| &nbsp; &nbsp; &nbsp; baseProductsRelationData.quantity           | int                                                                 | required                    |             |
| &nbsp; &nbsp; &nbsp; baseProductsRelationData.variationLabel     | string                                                              | required                    |             |
| &nbsp; &nbsp; &nbsp; baseProductsRelationData.defaultProduct     | string                                                              | required                    |             |
| &nbsp; &nbsp; &nbsp; baseProductsRelationData.position           | int                                                                 | required                    |             |
| **&nbsp; &nbsp; &nbsp; baseProductsRelationData.ebayVariationData** | Wundii\AfterbuySdk\Dto\GetShopProducts\EbayVariationData            | null                        |             |
| &nbsp; &nbsp; &nbsp; &nbsp; ebayVariationData.ebayVariationName  | string                                                              | required                    |             |
| &nbsp; &nbsp; &nbsp; &nbsp; ebayVariationData.ebayVariationValue | string                                                              | required                    |             |
| &nbsp; products.shortDescription                                 | string                                                              | null                        |             |
| &nbsp; products.tags                                             | string[]                                                            | []                          |             |
| &nbsp; products.memo                                             | string                                                              | null                        |             |
| &nbsp; products.googleBaseLabels                                 | string                                                              | null                        |             |
| &nbsp; products.headerDescriptionName                            | string                                                              | null                        |             |
| &nbsp; products.headerDescriptionValue                           | string                                                              | null                        |             |
| &nbsp; products.description                                      | string                                                              | null                        |             |
| &nbsp; products.footerDescriptionName                            | string                                                              | null                        |             |
| &nbsp; products.footerDescriptionValue                           | string                                                              | null                        |             |
| &nbsp; products.googleBaseShipping                               | string                                                              | null                        |             |
| &nbsp; products.keywords                                         | string                                                              | null                        |             |
| &nbsp; products.quantity                                         | int                                                                 | null                        |             |
| &nbsp; products.availableShop                                    | bool                                                                | false                       |             |
| &nbsp; products.auctionQuantity                                  | int                                                                 | null                        |             |
| &nbsp; products.stock                                            | bool                                                                | false                       |             |
| &nbsp; products.discontinued                                     | bool                                                                | false                       |             |
| &nbsp; products.mergeStock                                       | bool                                                                | false                       |             |
| &nbsp; products.unitOfQuantity                                   | string                                                              | null                        |             |
| &nbsp; products.basepriceFactor                                  | int                                                                 | null                        |             |
| &nbsp; products.minimumStock                                     | int                                                                 | null                        |             |
| &nbsp; products.minimumOrderQuantity                             | int                                                                 | null                        |             |
| &nbsp; products.fullFilmentQuantity                              | int                                                                 | null                        |             |
| &nbsp; products.fullFilmentImport                                | DateTimeInterface                                                   | null                        |             |
| &nbsp; products.sellingPrice                                     | float                                                               | null                        |             |
| &nbsp; products.buyingPrice                                      | float                                                               | null                        |             |
| &nbsp; products.dealerPrice                                      | float                                                               | null                        |             |
| &nbsp; products.level                                            | int                                                                 | null                        |             |
| &nbsp; products.position                                         | int                                                                 | null                        |             |
| &nbsp; products.titleReplace                                     | bool                                                                | false                       |             |
| **&nbsp; products.scaledDiscounts**                              | Wundii\AfterbuySdk\Dto\GetShopProducts\ScaledDiscount[]             | []                          |             |
| &nbsp; &nbsp; scaledDiscounts.scaledQuantity                     | int                                                                 | null                        |             |
| &nbsp; &nbsp; scaledDiscounts.scaledPrice                        | float                                                               | null                        |             |
| &nbsp; &nbsp; scaledDiscounts.scaledDPrice                       | float                                                               | null                        |             |
| &nbsp; products.taxRate                                          | float                                                               | null                        |             |
| &nbsp; products.weight                                           | float                                                               | null                        |             |
| &nbsp; products.searchAlias                                      | string                                                              | null                        |             |
| &nbsp; products.froogle                                          | bool                                                                | false                       |             |
| &nbsp; products.kelkoo                                           | bool                                                                | false                       |             |
| &nbsp; products.shippingGroup                                    | string                                                              | null                        |             |
| &nbsp; products.shopShippingGroup                                | string                                                              | null                        |             |
| &nbsp; products.searchEngineShipping                             | string                                                              | null                        |             |
| &nbsp; products.crossCatalogID                                   | int                                                                 | null                        |             |
| **&nbsp; products.features**                                     | Wundii\AfterbuySdk\Dto\GetShopProducts\Feature[]                    | []                          |             |
| &nbsp; &nbsp; features.id                                        | int                                                                 | required                    |             |
| &nbsp; &nbsp; features.name                                      | string                                                              | required                    |             |
| &nbsp; &nbsp; features.value                                     | string                                                              | required                    |             |
| &nbsp; products.freeValue1                                       | string                                                              | null                        |             |
| &nbsp; products.freeValue2                                       | string                                                              | null                        |             |
| &nbsp; products.freeValue3                                       | string                                                              | null                        |             |
| &nbsp; products.freeValue4                                       | string                                                              | null                        |             |
| &nbsp; products.freeValue5                                       | string                                                              | null                        |             |
| &nbsp; products.freeValue6                                       | string                                                              | null                        |             |
| &nbsp; products.freeValue7                                       | string                                                              | null                        |             |
| &nbsp; products.freeValue8                                       | string                                                              | null                        |             |
| &nbsp; products.freeValue9                                       | string                                                              | null                        |             |
| &nbsp; products.freeValue10                                      | string                                                              | null                        |             |
| &nbsp; products.deliveryTime                                     | string                                                              | null                        |             |
| &nbsp; products.stocklocation_1                                  | string                                                              | null                        |             |
| &nbsp; products.stocklocation_2                                  | string                                                              | null                        |             |
| &nbsp; products.stocklocation_3                                  | string                                                              | null                        |             |
| &nbsp; products.stocklocation_4                                  | string                                                              | null                        |             |
| &nbsp; products.countryOfOriginEnum                              | Wundii\AfterbuySdk\Enum\CountryOfOriginEnum                         | null                        |             |
| &nbsp; products.lastSale                                         | DateTimeInterface                                                   | null                        |             |
| &nbsp; products.imageSmallURL                                    | string                                                              | null                        |             |
| &nbsp; products.imageLargeURL                                    | string                                                              | null                        |             |
| &nbsp; products.amazonStandardProductIdType                      | string                                                              | null                        |             |
| &nbsp; products.amazonStandardProductIdValue                     | string                                                              | null                        |             |
| &nbsp; products.manufacturerStandardProductIdType                | string                                                              | null                        |             |
| &nbsp; products.manufacturerStandardProductIdValue               | string                                                              | null                        |             |
| &nbsp; products.productBrand                                     | string                                                              | null                        |             |
| &nbsp; products.customsTariffNumber                              | string                                                              | null                        |             |
| &nbsp; products.manufacturerPartNumber                           | string                                                              | null                        |             |
| &nbsp; products.facebook                                         | bool                                                                | false                       |             |
| &nbsp; products.googleProductCategory                            | string                                                              | null                        |             |
| &nbsp; products.adwordsGrouping                                  | string                                                              | null                        |             |
| &nbsp; products.conditionEnum                                    | Wundii\AfterbuySdk\Enum\ConditionEnum                               | ConditionEnum::NO_CONDITION |             |
| &nbsp; products.ageGroupEnum                                     | Wundii\AfterbuySdk\Enum\AgeGroupEnum                                | null                        |             |
| &nbsp; products.genderEnum                                       | Wundii\AfterbuySdk\Enum\GenderEnum                                  | null                        |             |
| &nbsp; products.pattern                                          | string                                                              | null                        |             |
| &nbsp; products.material                                         | string                                                              | null                        |             |
| &nbsp; products.itemColor                                        | string                                                              | null                        |             |
| &nbsp; products.itemSize                                         | string                                                              | null                        |             |
| &nbsp; products.customLabel0                                     | string                                                              | null                        |             |
| &nbsp; products.customLabel1                                     | string                                                              | null                        |             |
| &nbsp; products.customLabel2                                     | string                                                              | null                        |             |
| &nbsp; products.customLabel3                                     | string                                                              | null                        |             |
| &nbsp; products.customLabel4                                     | string                                                              | null                        |             |
| &nbsp; products.canonicalUrl                                     | string                                                              | null                        |             |
| &nbsp; products.energyClassEnum                                  | Wundii\AfterbuySdk\Enum\EnergyClassEnum                             | EnergyClassEnum::NO_CLASS   |             |
| &nbsp; products.dataSheetUrl                                     | string                                                              | null                        |             |
| &nbsp; products.skus                                             | string[]                                                            | []                          |             |
| **&nbsp; products.productPictures**                              | Wundii\AfterbuySdk\Dto\GetShopProducts\ProductPicture[]             | []                          |             |
| &nbsp; &nbsp; productPictures.nr                                 | int                                                                 | null                        |             |
| &nbsp; &nbsp; productPictures.typ                                | int                                                                 | null                        |             |
| &nbsp; &nbsp; productPictures.url                                | string                                                              | null                        |             |
| &nbsp; &nbsp; productPictures.altText                            | string                                                              | null                        |             |
| **&nbsp; &nbsp; productPictures.childs**                         | Wundii\AfterbuySdk\Dto\GetShopProducts\ProductPictureChild[]        | []                          |             |
| &nbsp; &nbsp; &nbsp; childs.nr                                   | int                                                                 | null                        |             |
| &nbsp; &nbsp; &nbsp; childs.typ                                  | int                                                                 | null                        |             |
| &nbsp; &nbsp; &nbsp; childs.url                                  | string                                                              | null                        |             |
| &nbsp; &nbsp; &nbsp; childs.altText                              | string                                                              | null                        |             |
| &nbsp; products.catalogs                                         | int[]                                                               | []                          |             |
| **&nbsp; products.attributes**                                   | Wundii\AfterbuySdk\Dto\GetShopProducts\Attribut[]                   | []                          |             |
| &nbsp; &nbsp; attributes.attributName                            | string                                                              | null                        |             |
| &nbsp; &nbsp; attributes.attributWert                            | string                                                              | null                        |             |
| &nbsp; &nbsp; attributes.attributTyp                             | int                                                                 | null                        |             |
| &nbsp; &nbsp; attributes.attributRequired                        | bool                                                                | false                       |             |
| **&nbsp; products.partsFitment**                                 | Wundii\AfterbuySdk\Dto\GetShopProducts\PartsProperties[]            | []                          |             |
| **&nbsp; &nbsp; partsFitment.partsProperty**                     | Wundii\AfterbuySdk\Dto\GetShopProducts\PartsProperty[]              | required                    |             |
| &nbsp; &nbsp; &nbsp; partsProperty.propertyNameEnum              | Wundii\AfterbuySdk\Enum\PropertyNameEnum                            | required                    |             |
| &nbsp; &nbsp; &nbsp; partsProperty.propertyValue                 | string                                                              | required                    |             |
| **&nbsp; products.additionalDescriptionFields**                  | Wundii\AfterbuySdk\Dto\GetShopProducts\AdditionalDescriptionField[] | []                          |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldId                | int                                                                 | null                        |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldName              | string                                                              | null                        |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldLabel             | string                                                              | null                        |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldContent           | string                                                              | null                        |             |
| **&nbsp; products.additionalPrices**                             | Wundii\AfterbuySdk\Dto\GetShopProducts\AdditionalPrice[]            | []                          |             |
| &nbsp; &nbsp; additionalPrices.definitionId                      | int                                                                 | null                        |             |
| &nbsp; &nbsp; additionalPrices.name                              | string                                                              | null                        |             |
| &nbsp; &nbsp; additionalPrices.value                             | float                                                               | null                        |             |
| &nbsp; &nbsp; additionalPrices.pretax                            | bool                                                                | null                        |             |
| **&nbsp; products.economicOperators**                            | Wundii\AfterbuySdk\Dto\GetShopProducts\EconomicOperator[]           | []                          |             |
| &nbsp; &nbsp; economicOperators.company                          | string                                                              | null                        |             |
| &nbsp; &nbsp; economicOperators.street1                          | string                                                              | null                        |             |
| &nbsp; &nbsp; economicOperators.street2                          | string                                                              | null                        |             |
| &nbsp; &nbsp; economicOperators.postalCode                       | string                                                              | null                        |             |
| &nbsp; &nbsp; economicOperators.city                             | string                                                              | null                        |             |
| &nbsp; &nbsp; economicOperators.stateOrProvince                  | string                                                              | null                        |             |
| &nbsp; &nbsp; economicOperators.countryIsoEnum                   | Wundii\AfterbuySdk\Enum\CountryIsoEnum                              | null                        |             |
| &nbsp; &nbsp; economicOperators.email                            | string                                                              | null                        |             |
| &nbsp; &nbsp; economicOperators.phone                            | string                                                              | null                        |             |
| shippingServicesList                                             | string                                                              | null                        |             |
| **paginationResult**                                             | Wundii\AfterbuySdk\Dto\GetShopProducts\PaginationResult             | null                        |             |
| &nbsp; paginationResult.totalNumberOfEntries                     | int                                                                 | required                    |             |
| &nbsp; paginationResult.totalNumberOfPages                       | int                                                                 | required                    |             |
| &nbsp; paginationResult.itemsPerPage                             | int                                                                 | required                    |             |
| &nbsp; paginationResult.pageNumber                               | int                                                                 | required                    |             |
