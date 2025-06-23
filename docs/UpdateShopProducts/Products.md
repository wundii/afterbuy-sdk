# Wundii\AfterbuySdk\Dto\UpdateShopProducts\Products
- [Back to Structron Documentation](/var/www/afterbuy-sdk/docs//_Structron.md)
- [Go to Products.php](/var/www/afterbuy-sdk/src/Dto/UpdateShopProducts/Products.php)

Holds a list of payment services.

| Products                                                          | Type                                                                   | Default  | Description |
| ----------------------------------------------------------------- | ---------------------------------------------------------------------- | -------- | ----------- |
| **products**                                                      | Wundii\AfterbuySdk\Dto\UpdateShopProducts\Product[]                    | []       |             |
| **&nbsp; products.productIdent**                                  | Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductIdent                 | required |             |
| &nbsp; &nbsp; productIdent.userProductId                          | string                                                                 | required |             |
| &nbsp; &nbsp; productIdent.baseProductTypeEnum                    | Wundii\AfterbuySdk\Enum\BaseProductTypeEnum                            | null     |             |
| &nbsp; &nbsp; productIdent.productInsert                          | bool                                                                   | null     |             |
| &nbsp; &nbsp; productIdent.productId                              | int                                                                    | null     |             |
| &nbsp; &nbsp; productIdent.anr                                    | int                                                                    | null     |             |
| &nbsp; &nbsp; productIdent.ean                                    | string                                                                 | null     |             |
| &nbsp; products.name                                              | string                                                                 | required |             |
| &nbsp; products.anr                                               | int                                                                    | null     |             |
| &nbsp; products.ean                                               | string                                                                 | null     |             |
| &nbsp; products.headerId                                          | int                                                                    | null     |             |
| &nbsp; products.footerId                                          | int                                                                    | null     |             |
| &nbsp; products.manufacturerPartNumber                            | string                                                                 | null     |             |
| &nbsp; products.shortDescription                                  | string                                                                 | null     |             |
| &nbsp; products.memo                                              | string                                                                 | null     |             |
| &nbsp; products.description                                       | string                                                                 | null     |             |
| &nbsp; products.keywords                                          | string                                                                 | null     |             |
| &nbsp; products.quantity                                          | int                                                                    | null     |             |
| &nbsp; products.auctionQuantity                                   | int                                                                    | null     |             |
| &nbsp; products.addQuantity                                       | int                                                                    | null     |             |
| &nbsp; products.addAuctionQuantity                                | int                                                                    | null     |             |
| &nbsp; products.stock                                             | bool                                                                   | null     |             |
| &nbsp; products.discontinued                                      | bool                                                                   | null     |             |
| &nbsp; products.mergeStock                                        | bool                                                                   | null     |             |
| &nbsp; products.unitOfQuantity                                    | float                                                                  | null     |             |
| &nbsp; products.basePriceFactorEnum                               | Wundii\AfterbuySdk\Enum\BasePriceFactorEnum                            | null     |             |
| &nbsp; products.minimumStock                                      | int                                                                    | null     |             |
| &nbsp; products.sellingPrice                                      | float                                                                  | null     |             |
| &nbsp; products.buyingPrice                                       | float                                                                  | null     |             |
| &nbsp; products.dealerPrice                                       | float                                                                  | null     |             |
| &nbsp; products.level                                             | int                                                                    | null     |             |
| &nbsp; products.position                                          | int                                                                    | null     |             |
| &nbsp; products.titleReplace                                      | bool                                                                   | null     |             |
| **&nbsp; products.scaledDiscounts**                               | Wundii\AfterbuySdk\Dto\UpdateShopProducts\ScaledDiscount[]             | []       |             |
| &nbsp; &nbsp; scaledDiscounts.scaledQuantity                      | int                                                                    | null     |             |
| &nbsp; &nbsp; scaledDiscounts.scaledPrice                         | float                                                                  | null     |             |
| &nbsp; &nbsp; scaledDiscounts.scaledDPrice                        | float                                                                  | null     |             |
| &nbsp; products.taxRate                                           | float                                                                  | null     |             |
| &nbsp; products.weight                                            | float                                                                  | null     |             |
| &nbsp; products.stocklocation_1                                   | string                                                                 | null     |             |
| &nbsp; products.stocklocation_2                                   | string                                                                 | null     |             |
| &nbsp; products.stocklocation_3                                   | string                                                                 | null     |             |
| &nbsp; products.stocklocation_4                                   | string                                                                 | null     |             |
| &nbsp; products.countryOfOriginEnum                               | Wundii\AfterbuySdk\Enum\CountryOfOriginEnum                            | null     |             |
| &nbsp; products.searchAlias                                       | string                                                                 | null     |             |
| &nbsp; products.froogle                                           | bool                                                                   | null     |             |
| &nbsp; products.kelkoo                                            | bool                                                                   | null     |             |
| &nbsp; products.shippingGroup                                     | string                                                                 | null     |             |
| &nbsp; products.shopShippingGroup                                 | string                                                                 | null     |             |
| &nbsp; products.crossCatalogId                                    | int                                                                    | null     |             |
| &nbsp; products.freeValue1                                        | string                                                                 | null     |             |
| &nbsp; products.freeValue2                                        | string                                                                 | null     |             |
| &nbsp; products.freeValue3                                        | string                                                                 | null     |             |
| &nbsp; products.freeValue4                                        | string                                                                 | null     |             |
| &nbsp; products.freeValue5                                        | string                                                                 | null     |             |
| &nbsp; products.freeValue6                                        | string                                                                 | null     |             |
| &nbsp; products.freeValue7                                        | string                                                                 | null     |             |
| &nbsp; products.freeValue8                                        | string                                                                 | null     |             |
| &nbsp; products.freeValue9                                        | string                                                                 | null     |             |
| &nbsp; products.freeValue10                                       | string                                                                 | null     |             |
| &nbsp; products.deliveryTime                                      | string                                                                 | null     |             |
| &nbsp; products.imageSmallUrl                                     | string                                                                 | null     |             |
| &nbsp; products.imageLargeUrl                                     | string                                                                 | null     |             |
| &nbsp; products.imageNameBase64                                   | string                                                                 | null     |             |
| &nbsp; products.imageSourceBase64                                 | string                                                                 | null     |             |
| &nbsp; products.manufacturerStandardProductIdType                 | string                                                                 | null     |             |
| &nbsp; products.manufacturerStandardProductIdValue                | string                                                                 | null     |             |
| &nbsp; products.productBrand                                      | string                                                                 | null     |             |
| &nbsp; products.customsTariffNumber                               | string                                                                 | null     |             |
| &nbsp; products.googleProductCategory                             | string                                                                 | null     |             |
| &nbsp; products.conditionEnum                                     | Wundii\AfterbuySdk\Enum\ConditionEnum                                  | null     |             |
| &nbsp; products.pattern                                           | string                                                                 | null     |             |
| &nbsp; products.material                                          | string                                                                 | null     |             |
| &nbsp; products.itemColor                                         | string                                                                 | null     |             |
| &nbsp; products.itemSize                                          | string                                                                 | null     |             |
| &nbsp; products.seoName                                           | string                                                                 | null     |             |
| &nbsp; products.canonicalUrl                                      | string                                                                 | null     |             |
| &nbsp; products.energyClassEnum                                   | Wundii\AfterbuySdk\Enum\EnergyClassEnum                                | null     |             |
| &nbsp; products.energyClassPictureUrl                             | string                                                                 | null     |             |
| &nbsp; products.dataSheetUrl                                      | string                                                                 | null     |             |
| &nbsp; products.genderEnum                                        | Wundii\AfterbuySdk\Enum\GenderEnum                                     | null     |             |
| &nbsp; products.ageGroupEnum                                      | Wundii\AfterbuySdk\Enum\AgeGroupEnum                                   | null     |             |
| **&nbsp; products.economicoperators**                             | Wundii\AfterbuySdk\Dto\UpdateShopProducts\Economicoperators            | null     |             |
| &nbsp; &nbsp; economicoperators.updateActionEconomicoperatorsEnum | Wundii\AfterbuySdk\Enum\UpdateActionEconomicoperatorsEnum              | required |             |
| &nbsp; &nbsp; economicoperators.economicoperatorId                | int[]                                                                  | required |             |
| &nbsp; products.tags                                              | string[]                                                               | []       |             |
| **&nbsp; products.skus**                                          | Wundii\AfterbuySdk\Dto\UpdateShopProducts\Skus                         | null     |             |
| &nbsp; &nbsp; skus.updateActionSkusEnum                           | Wundii\AfterbuySdk\Enum\UpdateActionSkusEnum                           | required |             |
| &nbsp; &nbsp; skus.skus                                           | string[]                                                               | required |             |
| **&nbsp; products.addCatalogs**                                   | Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddCatalogs                  | null     |             |
| &nbsp; &nbsp; addCatalogs.updateActionAddCatalogsEnum             | Wundii\AfterbuySdk\Enum\UpdateActionAddCatalogsEnum                    | required |             |
| **&nbsp; &nbsp; addCatalogs.addCatalog**                          | Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddCatalog[]                 | required |             |
| &nbsp; &nbsp; &nbsp; addCatalog.catalogId                         | int                                                                    | null     |             |
| &nbsp; &nbsp; &nbsp; addCatalog.catalogName                       | string                                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; addCatalog.catalogLevel                      | int                                                                    | null     |             |
| **&nbsp; products.addAttributes**                                 | Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddAttributes                | null     |             |
| &nbsp; &nbsp; addAttributes.updateActionAttributesEnum            | Wundii\AfterbuySdk\Enum\UpdateActionAttributesEnum                     | required |             |
| **&nbsp; &nbsp; addAttributes.addAttributes**                     | Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddAttribut[]                | required |             |
| &nbsp; &nbsp; &nbsp; addAttributes.AttributName                   | string                                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; addAttributes.AttributValue                  | string                                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; addAttributes.attributTypEnum                | Wundii\AfterbuySdk\Enum\AttributTypEnum                                | null     |             |
| &nbsp; &nbsp; &nbsp; addAttributes.attributePosition              | int                                                                    | null     |             |
| &nbsp; &nbsp; &nbsp; addAttributes.AttributRequired               | bool                                                                   | null     |             |
| **&nbsp; products.addBaseProducts**                               | Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddBaseProducts              | null     |             |
| &nbsp; &nbsp; addBaseProducts.updateActionAddBaseProductEnum      | Wundii\AfterbuySdk\Enum\UpdateActionAddBaseProductEnum                 | required |             |
| **&nbsp; &nbsp; addBaseProducts.addBaseProducts**                 | Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddBaseProduct[]             | required |             |
| &nbsp; &nbsp; &nbsp; addBaseProducts.productId                    | int                                                                    | null     |             |
| &nbsp; &nbsp; &nbsp; addBaseProducts.productLabel                 | string                                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; addBaseProducts.productPos                   | int                                                                    | null     |             |
| &nbsp; &nbsp; &nbsp; addBaseProducts.defaultProduct               | bool                                                                   | null     |             |
| &nbsp; &nbsp; &nbsp; addBaseProducts.productQuantity              | int                                                                    | null     |             |
| **&nbsp; products.useEbayVariations**                             | Wundii\AfterbuySdk\Dto\UpdateShopProducts\Variation[]                  | []       |             |
| &nbsp; &nbsp; useEbayVariations.variationName                     | string                                                                 | required |             |
| **&nbsp; &nbsp; useEbayVariations.variationValues**               | Wundii\AfterbuySdk\Dto\UpdateShopProducts\VariationValue[]             | required |             |
| &nbsp; &nbsp; &nbsp; variationValues.validForProdId               | int                                                                    | null     |             |
| &nbsp; &nbsp; &nbsp; variationValues.variationValue               | string                                                                 | null     |             |
| &nbsp; &nbsp; &nbsp; variationValues.variationPos                 | int                                                                    | null     |             |
| &nbsp; &nbsp; &nbsp; variationValues.variationPicUrl              | string                                                                 | null     |             |
| **&nbsp; products.partsFitment**                                  | Wundii\AfterbuySdk\Dto\UpdateShopProducts\PartsProperties[]            | []       |             |
| **&nbsp; &nbsp; partsFitment.partsProperties**                    | Wundii\AfterbuySdk\Dto\UpdateShopProducts\PartsProperty[]              | required |             |
| &nbsp; &nbsp; &nbsp; partsProperties.propertyNameEnum             | Wundii\AfterbuySdk\Enum\PropertyNameEnum                               | required |             |
| &nbsp; &nbsp; &nbsp; partsProperties.propertyValue                | string                                                                 | required |             |
| **&nbsp; products.additionalPriceUpdates**                        | Wundii\AfterbuySdk\Dto\UpdateShopProducts\AdditionalPriceUpdate[]      | []       |             |
| &nbsp; &nbsp; additionalPriceUpdates.definitionId                 | int                                                                    | required |             |
| &nbsp; &nbsp; additionalPriceUpdates.productId                    | int                                                                    | required |             |
| &nbsp; &nbsp; additionalPriceUpdates.price                        | float                                                                  | required |             |
| **&nbsp; products.additionalDescriptionFields**                   | Wundii\AfterbuySdk\Dto\UpdateShopProducts\AdditionalDescriptionField[] | []       |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldIdIdent            | int                                                                    | null     |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldNameIdent          | string                                                                 | null     |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldName               | string                                                                 | null     |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldLabel              | string                                                                 | null     |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldContent            | string                                                                 | null     |             |
| **&nbsp; products.productPictures**                               | Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductPicture[]             | []       |             |
| &nbsp; &nbsp; productPictures.nr                                  | int                                                                    | required |             |
| &nbsp; &nbsp; productPictures.url                                 | string                                                                 | required |             |
| &nbsp; &nbsp; productPictures.altText                             | string                                                                 | required |             |
| **&nbsp; &nbsp; productPictures.childs**                          | Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductPictureChild[]        | []       |             |
| &nbsp; &nbsp; &nbsp; childs.pictureTypEnum                        | Wundii\AfterbuySdk\Enum\PictureTypEnum                                 | required |             |
| &nbsp; &nbsp; &nbsp; childs.url                                   | string                                                                 | required |             |
| &nbsp; &nbsp; &nbsp; childs.altText                               | string                                                                 | required |             |
| **&nbsp; products.features**                                      | Wundii\AfterbuySdk\Dto\UpdateShopProducts\Feature[]                    | []       |             |
| &nbsp; &nbsp; features.id                                         | int                                                                    | required |             |
| &nbsp; &nbsp; features.value                                      | string                                                                 | required |             |
