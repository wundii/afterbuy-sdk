# Wundii\AfterbuySdk\Dto\UpdateShopProducts\Products
- [Back to Structron Documentation](./../_Structron.md)
- [Go to Products.php](./../../src/Dto/UpdateShopProducts/Products.php)

Holds a list of payment services.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddAttribut | AddAttribut |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddAttributes | AddAttributes |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddBaseProduct | AddBaseProduct |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddBaseProducts | AddBaseProducts |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddCatalog | AddCatalog |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddCatalogs | AddCatalogs |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\AdditionalDescriptionField | AdditionalDescriptionField |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\AdditionalPriceUpdate | AdditionalPriceUpdate |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\Economicoperators | Economicoperators |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\Feature | Feature |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\PartsProperties | PartsProperties |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\PartsProperty | PartsProperty |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\Product | Product |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductIdent | ProductIdent |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductPicture | ProductPicture |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductPictureChild | ProductPictureChild |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\ScaledDiscount | ScaledDiscount |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\Skus | Skus |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\Variation | Variation |
| Wundii\AfterbuySdk\Dto\UpdateShopProducts\VariationValue | VariationValue |
| Wundii\AfterbuySdk\Enum\AgeGroupEnum | AgeGroupEnum |
| Wundii\AfterbuySdk\Enum\AttributTypEnum | AttributTypEnum |
| Wundii\AfterbuySdk\Enum\BasePriceFactorEnum | BasePriceFactorEnum |
| Wundii\AfterbuySdk\Enum\BaseProductTypeEnum | BaseProductTypeEnum |
| Wundii\AfterbuySdk\Enum\ConditionEnum | ConditionEnum |
| Wundii\AfterbuySdk\Enum\CountryOfOriginEnum | CountryOfOriginEnum |
| Wundii\AfterbuySdk\Enum\EnergyClassEnum | EnergyClassEnum |
| Wundii\AfterbuySdk\Enum\GenderEnum | GenderEnum |
| Wundii\AfterbuySdk\Enum\PictureTypEnum | PictureTypEnum |
| Wundii\AfterbuySdk\Enum\PropertyNameEnum | PropertyNameEnum |
| Wundii\AfterbuySdk\Enum\UpdateActionAddBaseProductEnum | UpdateActionAddBaseProductEnum |
| Wundii\AfterbuySdk\Enum\UpdateActionAddCatalogsEnum | UpdateActionAddCatalogsEnum |
| Wundii\AfterbuySdk\Enum\UpdateActionAttributesEnum | UpdateActionAttributesEnum |
| Wundii\AfterbuySdk\Enum\UpdateActionEconomicoperatorsEnum | UpdateActionEconomicoperatorsEnum |
| Wundii\AfterbuySdk\Enum\UpdateActionSkusEnum | UpdateActionSkusEnum |

## Properties
| Products                                                          | Type                              | Default  | Description |
| ----------------------------------------------------------------- | --------------------------------- | -------- | ----------- |
| **products**                                                      | Product[]                         | []       |             |
| **&nbsp; products.productIdent**                                  | ProductIdent                      | required |             |
| &nbsp; &nbsp; productIdent.userProductId                          | string                            | required |             |
| &nbsp; &nbsp; productIdent.baseProductTypeEnum                    | BaseProductTypeEnum               | null     |             |
| &nbsp; &nbsp; productIdent.productInsert                          | bool                              | null     |             |
| &nbsp; &nbsp; productIdent.productId                              | int                               | null     |             |
| &nbsp; &nbsp; productIdent.anr                                    | int                               | null     |             |
| &nbsp; &nbsp; productIdent.ean                                    | string                            | null     |             |
| &nbsp; products.name                                              | string                            | required |             |
| &nbsp; products.anr                                               | int                               | null     |             |
| &nbsp; products.ean                                               | string                            | null     |             |
| &nbsp; products.headerId                                          | int                               | null     |             |
| &nbsp; products.footerId                                          | int                               | null     |             |
| &nbsp; products.manufacturerPartNumber                            | string                            | null     |             |
| &nbsp; products.shortDescription                                  | string                            | null     |             |
| &nbsp; products.memo                                              | string                            | null     |             |
| &nbsp; products.description                                       | string                            | null     |             |
| &nbsp; products.keywords                                          | string                            | null     |             |
| &nbsp; products.quantity                                          | int                               | null     |             |
| &nbsp; products.auctionQuantity                                   | int                               | null     |             |
| &nbsp; products.addQuantity                                       | int                               | null     |             |
| &nbsp; products.addAuctionQuantity                                | int                               | null     |             |
| &nbsp; products.stock                                             | bool                              | null     |             |
| &nbsp; products.discontinued                                      | bool                              | null     |             |
| &nbsp; products.mergeStock                                        | bool                              | null     |             |
| &nbsp; products.unitOfQuantity                                    | float                             | null     |             |
| &nbsp; products.basePriceFactorEnum                               | BasePriceFactorEnum               | null     |             |
| &nbsp; products.minimumStock                                      | int                               | null     |             |
| &nbsp; products.sellingPrice                                      | float                             | null     |             |
| &nbsp; products.buyingPrice                                       | float                             | null     |             |
| &nbsp; products.dealerPrice                                       | float                             | null     |             |
| &nbsp; products.level                                             | int                               | null     |             |
| &nbsp; products.position                                          | int                               | null     |             |
| &nbsp; products.titleReplace                                      | bool                              | null     |             |
| **&nbsp; products.scaledDiscounts**                               | ScaledDiscount[]                  | []       |             |
| &nbsp; &nbsp; scaledDiscounts.scaledQuantity                      | int                               | null     |             |
| &nbsp; &nbsp; scaledDiscounts.scaledPrice                         | float                             | null     |             |
| &nbsp; &nbsp; scaledDiscounts.scaledDPrice                        | float                             | null     |             |
| &nbsp; products.taxRate                                           | float                             | null     |             |
| &nbsp; products.weight                                            | float                             | null     |             |
| &nbsp; products.stocklocation_1                                   | string                            | null     |             |
| &nbsp; products.stocklocation_2                                   | string                            | null     |             |
| &nbsp; products.stocklocation_3                                   | string                            | null     |             |
| &nbsp; products.stocklocation_4                                   | string                            | null     |             |
| &nbsp; products.countryOfOriginEnum                               | CountryOfOriginEnum               | null     |             |
| &nbsp; products.searchAlias                                       | string                            | null     |             |
| &nbsp; products.froogle                                           | bool                              | null     |             |
| &nbsp; products.kelkoo                                            | bool                              | null     |             |
| &nbsp; products.shippingGroup                                     | string                            | null     |             |
| &nbsp; products.shopShippingGroup                                 | string                            | null     |             |
| &nbsp; products.crossCatalogId                                    | int                               | null     |             |
| &nbsp; products.freeValue1                                        | string                            | null     |             |
| &nbsp; products.freeValue2                                        | string                            | null     |             |
| &nbsp; products.freeValue3                                        | string                            | null     |             |
| &nbsp; products.freeValue4                                        | string                            | null     |             |
| &nbsp; products.freeValue5                                        | string                            | null     |             |
| &nbsp; products.freeValue6                                        | string                            | null     |             |
| &nbsp; products.freeValue7                                        | string                            | null     |             |
| &nbsp; products.freeValue8                                        | string                            | null     |             |
| &nbsp; products.freeValue9                                        | string                            | null     |             |
| &nbsp; products.freeValue10                                       | string                            | null     |             |
| &nbsp; products.deliveryTime                                      | string                            | null     |             |
| &nbsp; products.imageSmallUrl                                     | string                            | null     |             |
| &nbsp; products.imageLargeUrl                                     | string                            | null     |             |
| &nbsp; products.imageNameBase64                                   | string                            | null     |             |
| &nbsp; products.imageSourceBase64                                 | string                            | null     |             |
| &nbsp; products.manufacturerStandardProductIdType                 | string                            | null     |             |
| &nbsp; products.manufacturerStandardProductIdValue                | string                            | null     |             |
| &nbsp; products.productBrand                                      | string                            | null     |             |
| &nbsp; products.customsTariffNumber                               | string                            | null     |             |
| &nbsp; products.googleProductCategory                             | string                            | null     |             |
| &nbsp; products.conditionEnum                                     | ConditionEnum                     | null     |             |
| &nbsp; products.pattern                                           | string                            | null     |             |
| &nbsp; products.material                                          | string                            | null     |             |
| &nbsp; products.itemColor                                         | string                            | null     |             |
| &nbsp; products.itemSize                                          | string                            | null     |             |
| &nbsp; products.seoName                                           | string                            | null     |             |
| &nbsp; products.canonicalUrl                                      | string                            | null     |             |
| &nbsp; products.energyClassEnum                                   | EnergyClassEnum                   | null     |             |
| &nbsp; products.energyClassPictureUrl                             | string                            | null     |             |
| &nbsp; products.dataSheetUrl                                      | string                            | null     |             |
| &nbsp; products.genderEnum                                        | GenderEnum                        | null     |             |
| &nbsp; products.ageGroupEnum                                      | AgeGroupEnum                      | null     |             |
| **&nbsp; products.economicoperators**                             | Economicoperators                 | null     |             |
| &nbsp; &nbsp; economicoperators.updateActionEconomicoperatorsEnum | UpdateActionEconomicoperatorsEnum | required |             |
| &nbsp; &nbsp; economicoperators.economicoperatorId                | int[]                             | required |             |
| &nbsp; products.tags                                              | string[]                          | []       |             |
| **&nbsp; products.skus**                                          | Skus                              | null     |             |
| &nbsp; &nbsp; skus.updateActionSkusEnum                           | UpdateActionSkusEnum              | required |             |
| &nbsp; &nbsp; skus.skus                                           | string[]                          | required |             |
| **&nbsp; products.addCatalogs**                                   | AddCatalogs                       | null     |             |
| &nbsp; &nbsp; addCatalogs.updateActionAddCatalogsEnum             | UpdateActionAddCatalogsEnum       | required |             |
| **&nbsp; &nbsp; addCatalogs.addCatalog**                          | AddCatalog[]                      | required |             |
| &nbsp; &nbsp; &nbsp; addCatalog.catalogId                         | int                               | null     |             |
| &nbsp; &nbsp; &nbsp; addCatalog.catalogName                       | string                            | null     |             |
| &nbsp; &nbsp; &nbsp; addCatalog.catalogLevel                      | int                               | null     |             |
| **&nbsp; products.addAttributes**                                 | AddAttributes                     | null     |             |
| &nbsp; &nbsp; addAttributes.updateActionAttributesEnum            | UpdateActionAttributesEnum        | required |             |
| **&nbsp; &nbsp; addAttributes.addAttributes**                     | AddAttribut[]                     | required |             |
| &nbsp; &nbsp; &nbsp; addAttributes.AttributName                   | string                            | null     |             |
| &nbsp; &nbsp; &nbsp; addAttributes.AttributValue                  | string                            | null     |             |
| &nbsp; &nbsp; &nbsp; addAttributes.attributTypEnum                | AttributTypEnum                   | null     |             |
| &nbsp; &nbsp; &nbsp; addAttributes.attributePosition              | int                               | null     |             |
| &nbsp; &nbsp; &nbsp; addAttributes.AttributRequired               | bool                              | null     |             |
| **&nbsp; products.addBaseProducts**                               | AddBaseProducts                   | null     |             |
| &nbsp; &nbsp; addBaseProducts.updateActionAddBaseProductEnum      | UpdateActionAddBaseProductEnum    | required |             |
| **&nbsp; &nbsp; addBaseProducts.addBaseProducts**                 | AddBaseProduct[]                  | required |             |
| &nbsp; &nbsp; &nbsp; addBaseProducts.productId                    | int                               | null     |             |
| &nbsp; &nbsp; &nbsp; addBaseProducts.productLabel                 | string                            | null     |             |
| &nbsp; &nbsp; &nbsp; addBaseProducts.productPos                   | int                               | null     |             |
| &nbsp; &nbsp; &nbsp; addBaseProducts.defaultProduct               | bool                              | null     |             |
| &nbsp; &nbsp; &nbsp; addBaseProducts.productQuantity              | int                               | null     |             |
| **&nbsp; products.useEbayVariations**                             | Variation[]                       | []       |             |
| &nbsp; &nbsp; useEbayVariations.variationName                     | string                            | required |             |
| **&nbsp; &nbsp; useEbayVariations.variationValues**               | VariationValue[]                  | required |             |
| &nbsp; &nbsp; &nbsp; variationValues.validForProdId               | int                               | null     |             |
| &nbsp; &nbsp; &nbsp; variationValues.variationValue               | string                            | null     |             |
| &nbsp; &nbsp; &nbsp; variationValues.variationPos                 | int                               | null     |             |
| &nbsp; &nbsp; &nbsp; variationValues.variationPicUrl              | string                            | null     |             |
| **&nbsp; products.partsFitment**                                  | PartsProperties[]                 | []       |             |
| **&nbsp; &nbsp; partsFitment.partsProperties**                    | PartsProperty[]                   | required |             |
| &nbsp; &nbsp; &nbsp; partsProperties.propertyNameEnum             | PropertyNameEnum                  | required |             |
| &nbsp; &nbsp; &nbsp; partsProperties.propertyValue                | string                            | required |             |
| **&nbsp; products.additionalPriceUpdates**                        | AdditionalPriceUpdate[]           | []       |             |
| &nbsp; &nbsp; additionalPriceUpdates.definitionId                 | int                               | required |             |
| &nbsp; &nbsp; additionalPriceUpdates.productId                    | int                               | required |             |
| &nbsp; &nbsp; additionalPriceUpdates.price                        | float                             | required |             |
| **&nbsp; products.additionalDescriptionFields**                   | AdditionalDescriptionField[]      | []       |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldIdIdent            | int                               | null     |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldNameIdent          | string                            | null     |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldName               | string                            | null     |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldLabel              | string                            | null     |             |
| &nbsp; &nbsp; additionalDescriptionFields.fieldContent            | string                            | null     |             |
| **&nbsp; products.productPictures**                               | ProductPicture[]                  | []       |             |
| &nbsp; &nbsp; productPictures.nr                                  | int                               | required |             |
| &nbsp; &nbsp; productPictures.url                                 | string                            | required |             |
| &nbsp; &nbsp; productPictures.altText                             | string                            | required |             |
| **&nbsp; &nbsp; productPictures.childs**                          | ProductPictureChild[]             | []       |             |
| &nbsp; &nbsp; &nbsp; childs.pictureTypEnum                        | PictureTypEnum                    | required |             |
| &nbsp; &nbsp; &nbsp; childs.url                                   | string                            | required |             |
| &nbsp; &nbsp; &nbsp; childs.altText                               | string                            | required |             |
| **&nbsp; products.features**                                      | Feature[]                         | []       |             |
| &nbsp; &nbsp; features.id                                         | int                               | required |             |
| &nbsp; &nbsp; features.value                                      | string                            | required |             |
