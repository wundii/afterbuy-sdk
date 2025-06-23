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
| Products                                            | Type                              | Default  | Description |
| --------------------------------------------------- | --------------------------------- | -------- | ----------- |
| **products**                                        | Product[]                         | []       |             |
| **products.productIdent**                           | ProductIdent                      | required |             |
| productIdent.userProductId                          | string                            | required |             |
| productIdent.baseProductTypeEnum                    | BaseProductTypeEnum               | null     |             |
| productIdent.productInsert                          | bool                              | null     |             |
| productIdent.productId                              | int                               | null     |             |
| productIdent.anr                                    | int                               | null     |             |
| productIdent.ean                                    | string                            | null     |             |
| products.name                                       | string                            | required |             |
| products.anr                                        | int                               | null     |             |
| products.ean                                        | string                            | null     |             |
| products.headerId                                   | int                               | null     |             |
| products.footerId                                   | int                               | null     |             |
| products.manufacturerPartNumber                     | string                            | null     |             |
| products.shortDescription                           | string                            | null     |             |
| products.memo                                       | string                            | null     |             |
| products.description                                | string                            | null     |             |
| products.keywords                                   | string                            | null     |             |
| products.quantity                                   | int                               | null     |             |
| products.auctionQuantity                            | int                               | null     |             |
| products.addQuantity                                | int                               | null     |             |
| products.addAuctionQuantity                         | int                               | null     |             |
| products.stock                                      | bool                              | null     |             |
| products.discontinued                               | bool                              | null     |             |
| products.mergeStock                                 | bool                              | null     |             |
| products.unitOfQuantity                             | float                             | null     |             |
| products.basePriceFactorEnum                        | BasePriceFactorEnum               | null     |             |
| products.minimumStock                               | int                               | null     |             |
| products.sellingPrice                               | float                             | null     |             |
| products.buyingPrice                                | float                             | null     |             |
| products.dealerPrice                                | float                             | null     |             |
| products.level                                      | int                               | null     |             |
| products.position                                   | int                               | null     |             |
| products.titleReplace                               | bool                              | null     |             |
| **products.scaledDiscounts**                        | ScaledDiscount[]                  | []       |             |
| scaledDiscounts.scaledQuantity                      | int                               | null     |             |
| scaledDiscounts.scaledPrice                         | float                             | null     |             |
| scaledDiscounts.scaledDPrice                        | float                             | null     |             |
| products.taxRate                                    | float                             | null     |             |
| products.weight                                     | float                             | null     |             |
| products.stocklocation_1                            | string                            | null     |             |
| products.stocklocation_2                            | string                            | null     |             |
| products.stocklocation_3                            | string                            | null     |             |
| products.stocklocation_4                            | string                            | null     |             |
| products.countryOfOriginEnum                        | CountryOfOriginEnum               | null     |             |
| products.searchAlias                                | string                            | null     |             |
| products.froogle                                    | bool                              | null     |             |
| products.kelkoo                                     | bool                              | null     |             |
| products.shippingGroup                              | string                            | null     |             |
| products.shopShippingGroup                          | string                            | null     |             |
| products.crossCatalogId                             | int                               | null     |             |
| products.freeValue1                                 | string                            | null     |             |
| products.freeValue2                                 | string                            | null     |             |
| products.freeValue3                                 | string                            | null     |             |
| products.freeValue4                                 | string                            | null     |             |
| products.freeValue5                                 | string                            | null     |             |
| products.freeValue6                                 | string                            | null     |             |
| products.freeValue7                                 | string                            | null     |             |
| products.freeValue8                                 | string                            | null     |             |
| products.freeValue9                                 | string                            | null     |             |
| products.freeValue10                                | string                            | null     |             |
| products.deliveryTime                               | string                            | null     |             |
| products.imageSmallUrl                              | string                            | null     |             |
| products.imageLargeUrl                              | string                            | null     |             |
| products.imageNameBase64                            | string                            | null     |             |
| products.imageSourceBase64                          | string                            | null     |             |
| products.manufacturerStandardProductIdType          | string                            | null     |             |
| products.manufacturerStandardProductIdValue         | string                            | null     |             |
| products.productBrand                               | string                            | null     |             |
| products.customsTariffNumber                        | string                            | null     |             |
| products.googleProductCategory                      | string                            | null     |             |
| products.conditionEnum                              | ConditionEnum                     | null     |             |
| products.pattern                                    | string                            | null     |             |
| products.material                                   | string                            | null     |             |
| products.itemColor                                  | string                            | null     |             |
| products.itemSize                                   | string                            | null     |             |
| products.seoName                                    | string                            | null     |             |
| products.canonicalUrl                               | string                            | null     |             |
| products.energyClassEnum                            | EnergyClassEnum                   | null     |             |
| products.energyClassPictureUrl                      | string                            | null     |             |
| products.dataSheetUrl                               | string                            | null     |             |
| products.genderEnum                                 | GenderEnum                        | null     |             |
| products.ageGroupEnum                               | AgeGroupEnum                      | null     |             |
| **products.economicoperators**                      | Economicoperators                 | null     |             |
| economicoperators.updateActionEconomicoperatorsEnum | UpdateActionEconomicoperatorsEnum | required |             |
| economicoperators.economicoperatorId                | int[]                             | required |             |
| products.tags                                       | string[]                          | []       |             |
| **products.skus**                                   | Skus                              | null     |             |
| skus.updateActionSkusEnum                           | UpdateActionSkusEnum              | required |             |
| skus.skus                                           | string[]                          | required |             |
| **products.addCatalogs**                            | AddCatalogs                       | null     |             |
| addCatalogs.updateActionAddCatalogsEnum             | UpdateActionAddCatalogsEnum       | required |             |
| **addCatalogs.addCatalog**                          | AddCatalog[]                      | required |             |
| addCatalog.catalogId                                | int                               | null     |             |
| addCatalog.catalogName                              | string                            | null     |             |
| addCatalog.catalogLevel                             | int                               | null     |             |
| **products.addAttributes**                          | AddAttributes                     | null     |             |
| addAttributes.updateActionAttributesEnum            | UpdateActionAttributesEnum        | required |             |
| **addAttributes.addAttributes**                     | AddAttribut[]                     | required |             |
| addAttributes.AttributName                          | string                            | null     |             |
| addAttributes.AttributValue                         | string                            | null     |             |
| addAttributes.attributTypEnum                       | AttributTypEnum                   | null     |             |
| addAttributes.attributePosition                     | int                               | null     |             |
| addAttributes.AttributRequired                      | bool                              | null     |             |
| **products.addBaseProducts**                        | AddBaseProducts                   | null     |             |
| addBaseProducts.updateActionAddBaseProductEnum      | UpdateActionAddBaseProductEnum    | required |             |
| **addBaseProducts.addBaseProducts**                 | AddBaseProduct[]                  | required |             |
| addBaseProducts.productId                           | int                               | null     |             |
| addBaseProducts.productLabel                        | string                            | null     |             |
| addBaseProducts.productPos                          | int                               | null     |             |
| addBaseProducts.defaultProduct                      | bool                              | null     |             |
| addBaseProducts.productQuantity                     | int                               | null     |             |
| **products.useEbayVariations**                      | Variation[]                       | []       |             |
| useEbayVariations.variationName                     | string                            | required |             |
| **useEbayVariations.variationValues**               | VariationValue[]                  | required |             |
| variationValues.validForProdId                      | int                               | null     |             |
| variationValues.variationValue                      | string                            | null     |             |
| variationValues.variationPos                        | int                               | null     |             |
| variationValues.variationPicUrl                     | string                            | null     |             |
| **products.partsFitment**                           | PartsProperties[]                 | []       |             |
| **partsFitment.partsProperties**                    | PartsProperty[]                   | required |             |
| partsProperties.propertyNameEnum                    | PropertyNameEnum                  | required |             |
| partsProperties.propertyValue                       | string                            | required |             |
| **products.additionalPriceUpdates**                 | AdditionalPriceUpdate[]           | []       |             |
| additionalPriceUpdates.definitionId                 | int                               | required |             |
| additionalPriceUpdates.productId                    | int                               | required |             |
| additionalPriceUpdates.price                        | float                             | required |             |
| **products.additionalDescriptionFields**            | AdditionalDescriptionField[]      | []       |             |
| additionalDescriptionFields.fieldIdIdent            | int                               | null     |             |
| additionalDescriptionFields.fieldNameIdent          | string                            | null     |             |
| additionalDescriptionFields.fieldName               | string                            | null     |             |
| additionalDescriptionFields.fieldLabel              | string                            | null     |             |
| additionalDescriptionFields.fieldContent            | string                            | null     |             |
| **products.productPictures**                        | ProductPicture[]                  | []       |             |
| productPictures.nr                                  | int                               | required |             |
| productPictures.url                                 | string                            | required |             |
| productPictures.altText                             | string                            | required |             |
| **productPictures.childs**                          | ProductPictureChild[]             | []       |             |
| childs.pictureTypEnum                               | PictureTypEnum                    | required |             |
| childs.url                                          | string                            | required |             |
| childs.altText                                      | string                            | required |             |
| **products.features**                               | Feature[]                         | []       |             |
| features.id                                         | int                               | required |             |
| features.value                                      | string                            | required |             |
