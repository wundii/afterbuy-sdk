<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddAttribut;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddAttributes;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddBaseProduct;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddBaseProducts;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddCatalog;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AddCatalogs;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AdditionalDescriptionField;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\AdditionalPriceUpdate;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Economicoperators;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Feature;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\PartsProperties;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\PartsProperty;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Product;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductIdent;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Products;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\ScaledDiscount;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Skus;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Variation;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\VariationValue;
use Wundii\AfterbuySdk\Enum\AgeGroupEnum;
use Wundii\AfterbuySdk\Enum\AttributTypEnum;
use Wundii\AfterbuySdk\Enum\BasePriceFactorEnum;
use Wundii\AfterbuySdk\Enum\ConditionEnum;
use Wundii\AfterbuySdk\Enum\CountryOfOriginEnum;
use Wundii\AfterbuySdk\Enum\EnergyClassEnum;
use Wundii\AfterbuySdk\Enum\GenderEnum;
use Wundii\AfterbuySdk\Enum\PropertyNameEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionAddBaseProductEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionAddCatalogsEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionAttributesEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionEconomicoperatorsEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionSkusEnum;

class ProductsTest extends TestCase
{
    public function testConstructor(): void
    {
        $product = new Product(
            new ProductIdent(
                userProductId: '12346ABCD',
                baseProductTypeEnum: null,
                productInsert: true,
                productId: 0,
                anr: 0,
                ean: 'EAN',
            ),
            name: 'ABInterfaceNew TestItem',
            anr: 123456,
            ean: '123ABC',
            headerId: 111,
            footerId: 333,
            manufacturerPartNumber: 'C-B-A-Test',
            shortDescription: 'TestKurzbeschreibung',
            memo: 'TestMemo',
            description: 'TestBeschreibung',
            keywords: 'TestKeywords',
            quantity: 10,
            auctionQuantity: 100,
            addQuantity: 20,
            addAuctionQuantity: 30,
            stock: true,
            discontinued: true,
            mergeStock: true,
            unitOfQuantity: 2.55,
            basePriceFactorEnum: BasePriceFactorEnum::LITER,
            minimumStock: 5,
            sellingPrice: 1.23,
            buyingPrice: 2.34,
            dealerPrice: 3.45,
            level: 1000,
            position: 10000,
            titleReplace: true,
            scaledDiscounts: [
                new ScaledDiscount(1, 1.23, 2.34),
                new ScaledDiscount(2, 2.34, 3.45),
                new ScaledDiscount(3, 3.45, 4.56),
            ],
            taxRate: 16.5,
            weight: 2.33,
            stocklocation_1: 'Lagerort 1',
            stocklocation_2: 'Lagerort 2',
            stocklocation_3: 'Lagerort 3',
            stocklocation_4: 'Lagerort 4',
            countryOfOriginEnum: CountryOfOriginEnum::GERMANY,
            searchAlias: 'TestSuchalias',
            froogle: true,
            kelkoo: true,
            shippingGroup: 'Packstationtest',
            shopShippingGroup: 'ShopGruppe',
            crossCatalogId: 141556,
            freeValue1: 'TestFreeValue1',
            freeValue2: 'TestFreeValue2',
            freeValue3: 'TestFreeValue3',
            freeValue4: 'TestFreeValue4',
            freeValue5: 'TestFreeValue5',
            freeValue6: 'TestFreeValue6',
            freeValue7: 'TestFreeValue7',
            freeValue8: 'TestFreeValue8',
            freeValue9: 'TestFreeValue9',
            freeValue10: 'TestFreeValue10',
            deliveryTime: '3 Tage',
            imageSmallUrl: 'MyURLSmall',
            imageLargeUrl: 'MyURLBig',
            imageNameBase64: 'alien.jpg',
            imageSourceBase64: '/9j/4AAQSkZJRgABAQAASABIAAD/Z',
            manufacturerStandardProductIdType: 'type',
            manufacturerStandardProductIdValue: 'value',
            productBrand: 'brand',
            customsTariffNumber: '12345',
            googleProductCategory: 'test',
            conditionEnum: ConditionEnum::NEW,
            pattern: 'productPattern',
            material: 'wood',
            itemColor: 'brown',
            itemSize: 'xxl',
            seoName: 'seoName',
            canonicalUrl: 'https://www.example.com',
            energyClassEnum: EnergyClassEnum::A_PLUS_PLUS_PLUS,
            energyClassPictureUrl: 'https://www.example.com/energy-label',
            dataSheetUrl: 'https://www.example.com/data-sheet',
            genderEnum: GenderEnum::UNISEX,
            ageGroupEnum: AgeGroupEnum::KIDS,
            economicoperators: new Economicoperators(
                updateActionEconomicoperatorsEnum: UpdateActionEconomicoperatorsEnum::ADD,
                economicoperatorId: [
                    10000,
                    10001,
                    10002,
                ],
            ),
            tags: [
                'string',
            ],
            skus: new Skus(
                updateActionSkusEnum: UpdateActionSkusEnum::ADD,
                skus: [
                    'NewSKU1',
                    'NewSKU2',
                    'NewSKU3',
                    'NewSKU4',
                    'NewSKU5',
                    'NewSKU6',
                    'NewSKU7',
                    'NewSKU8',
                    'NewSKU9',
                    'NewSKU10',
                ],
            ),
            addCatalogs: new AddCatalogs(
                updateActionAddCatalogsEnum: UpdateActionAddCatalogsEnum::UPDATE,
                addCatalog: [
                    new AddCatalog(141556, 'MyNEW Katalog'),
                ],
            ),
            addAttributes: new AddAttributes(
                updateActionAttributesEnum: UpdateActionAttributesEnum::ADD_OR_UPDATE,
                addAttributes: [
                    new AddAttribut(
                        attributName: 'Attribut 5',
                        attributValue: '1;2;3;4',
                        attributTypEnum: AttributTypEnum::DROPDOWN,
                        attributPosition: 1000,
                        attributRequired: true,
                    ),
                ],
            ),
            addBaseProducts: new AddBaseProducts(
                updateActionAddBaseProductEnum: UpdateActionAddBaseProductEnum::UPDATE,
                addBaseProducts: [
                    new AddBaseProduct(
                        productId: 1234,
                        productLabel: 'TestLabel',
                        productPos: 1000,
                        defaultProduct: true,
                        productQuantity: 3,
                    ),
                ],
            ),
            useEbayVariations: [
                new Variation(
                    variationName: 'Grösse',
                    variationValues: [
                        new VariationValue(
                            validForProdId: 123456789,
                            variationValue: 'XXL',
                            variationPos: 1,
                            variationPicUrl: 'https://www.afterbuy.de/homesites/images/home/logo.gif',
                        ),
                    ],
                ),
                new Variation(
                    variationName: 'Farbe',
                    variationValues: [
                        new VariationValue(
                            validForProdId: 123456789,
                            variationValue: 'Blau',
                            variationPos: 1,
                            variationPicUrl: 'https://www.afterbuy.de/homesites/images/home/logo.gif',
                        ),
                    ],
                ),
            ],
            partsFitment: [
                new PartsProperties(
                    [
                        new PartsProperty(
                            propertyNameEnum: PropertyNameEnum::KType,
                            propertyValue: '3313',
                        ),
                        new PartsProperty(
                            propertyNameEnum: PropertyNameEnum::KType,
                            propertyValue: '3314',
                        ),
                        new PartsProperty(
                            propertyNameEnum: PropertyNameEnum::HSN,
                            propertyValue: '7107',
                        ),
                        new PartsProperty(
                            propertyNameEnum: PropertyNameEnum::TSN,
                            propertyValue: '449',
                        ),
                        new PartsProperty(
                            propertyNameEnum: PropertyNameEnum::TSN,
                            propertyValue: '450',
                        ),
                    ],
                ),
                new PartsProperties(
                    [
                        new PartsProperty(
                            propertyNameEnum: PropertyNameEnum::KType,
                            propertyValue: '3314',
                        ),
                        new PartsProperty(
                            propertyNameEnum: PropertyNameEnum::HSN,
                            propertyValue: '7107',
                        ),
                        new PartsProperty(
                            propertyNameEnum: PropertyNameEnum::TSN,
                            propertyValue: '203',
                        ),
                    ],
                ),
                new PartsProperties(
                    [
                        new PartsProperty(
                            propertyNameEnum: PropertyNameEnum::KType,
                            propertyValue: '3315',
                        ),
                    ],
                ),
                new PartsProperties(
                    [
                        new PartsProperty(
                            propertyNameEnum: PropertyNameEnum::KType,
                            propertyValue: '3316',
                        ),
                        new PartsProperty(
                            propertyNameEnum: PropertyNameEnum::HSN,
                            propertyValue: '',
                        ),
                    ],
                ),
            ],
            additionalPriceUpdates: [
                new AdditionalPriceUpdate(
                    definitionId: 1,
                    productId: 123456,
                    price: 1.23,
                ),
                new AdditionalPriceUpdate(
                    definitionId: 2,
                    productId: 234567,
                    price: 2.34,
                ),
            ],
            additionalDescriptionFields: [
                new AdditionalDescriptionField(
                    fieldIdIdent: 10,
                    fieldNameIdent: 'FieldNameIdent - 10',
                    fieldName: 'Name - 10',
                    fieldLabel: 'Label - 10',
                    fieldContent: 'Content - 10',
                ),
                new AdditionalDescriptionField(
                    fieldIdIdent: 11,
                    fieldNameIdent: 'FieldNameIdent - 11',
                    fieldName: 'Name - 11',
                    fieldLabel: 'Label - 11',
                    fieldContent: 'Content - 11',
                ),
                new AdditionalDescriptionField(
                    fieldIdIdent: 12,
                    fieldNameIdent: 'FieldNameIdent - 12',
                    fieldName: 'Name - 12',
                    fieldLabel: 'Label - 12',
                    fieldContent: 'Content - 12',
                ),
            ],
            productPictures: [],
            features: [
                new Feature(
                    id: 2000,
                    value: 'TestFeature 1',
                ),
                new Feature(
                    id: 2001,
                    value: 'TestFeature 2',
                ),
            ],
        );

        $products = new Products([$product]);

        $this->assertCount(1, $products->getProducts());
        $product = $products->getProducts()[0];
        $this->assertInstanceOf(Product::class, $product);
        $this->assertSame('ABInterfaceNew TestItem', $product->getName());
        $this->assertSame(123456, $product->getAnr());
        $this->assertSame('123ABC', $product->getEan());
        $this->assertSame(111, $product->getHeaderId());
        $this->assertSame(333, $product->getFooterId());
        $this->assertSame('C-B-A-Test', $product->getManufacturerPartNumber());
        $this->assertSame('TestKurzbeschreibung', $product->getShortDescription());
        $this->assertSame('TestMemo', $product->getMemo());
        $this->assertSame('TestBeschreibung', $product->getDescription());
        $this->assertSame('TestKeywords', $product->getKeywords());
        $this->assertSame(10, $product->getQuantity());
        $this->assertSame(100, $product->getAuctionQuantity());
        $this->assertSame(20, $product->getAddQuantity());
        $this->assertSame(30, $product->getAddAuctionQuantity());
        $this->assertTrue($product->getStock());
        $this->assertTrue($product->getDiscontinued());
        $this->assertTrue($product->getMergeStock());
        $this->assertSame(2.55, $product->getUnitOfQuantity());
        $this->assertSame(BasePriceFactorEnum::LITER, $product->getBasePriceFactor());
        $this->assertSame(5, $product->getMinimumStock());
        $this->assertSame(1.23, $product->getSellingPrice());
        $this->assertSame(2.34, $product->getBuyingPrice());
        $this->assertSame(3.45, $product->getDealerPrice());
        $this->assertSame(1000, $product->getLevel());
        $this->assertSame(10000, $product->getPosition());
        $this->assertTrue($product->getTitleReplace());
        $this->assertCount(3, $product->getScaledDiscounts());
        $this->assertSame(16.5, $product->getTaxRate());
        $this->assertSame(2.33, $product->getWeight());
        $this->assertSame('Lagerort 1', $product->getStocklocation1());
        $this->assertSame('Lagerort 2', $product->getStocklocation2());
        $this->assertSame('Lagerort 3', $product->getStocklocation3());
        $this->assertSame('Lagerort 4', $product->getStocklocation4());
        $this->assertSame(CountryOfOriginEnum::GERMANY, $product->getCountryOfOrigin());
        $this->assertSame('TestSuchalias', $product->getSearchAlias());
        $this->assertTrue($product->getFroogle());
        $this->assertTrue($product->getKelkoo());
        $this->assertSame('Packstationtest', $product->getShippingGroup());
        $this->assertSame('ShopGruppe', $product->getShopShippingGroup());
        $this->assertSame(141556, $product->getCrossCatalogId());
        $this->assertSame('TestFreeValue1', $product->getFreeValue1());
        $this->assertSame('TestFreeValue2', $product->getFreeValue2());
        $this->assertSame('TestFreeValue3', $product->getFreeValue3());
        $this->assertSame('TestFreeValue4', $product->getFreeValue4());
        $this->assertSame('TestFreeValue5', $product->getFreeValue5());
        $this->assertSame('TestFreeValue6', $product->getFreeValue6());
        $this->assertSame('TestFreeValue7', $product->getFreeValue7());
        $this->assertSame('TestFreeValue8', $product->getFreeValue8());
        $this->assertSame('TestFreeValue9', $product->getFreeValue9());
        $this->assertSame('TestFreeValue10', $product->getFreeValue10());
        $this->assertSame('3 Tage', $product->getDeliveryTime());
        $this->assertSame('MyURLSmall', $product->getImageSmallUrl());
        $this->assertSame('MyURLBig', $product->getImageLargeUrl());
        $this->assertSame('alien.jpg', $product->getImageNameBase64());
        $this->assertSame('/9j/4AAQSkZJRgABAQAASABIAAD/Z', $product->getImageSourceBase64());
        $this->assertSame('type', $product->getManufacturerStandardProductIdType());
        $this->assertSame('value', $product->getManufacturerStandardProductIdValue());
        $this->assertSame('brand', $product->getProductBrand());
        $this->assertSame('12345', $product->getCustomsTariffNumber());
        $this->assertSame('test', $product->getGoogleProductCategory());
        $this->assertSame(ConditionEnum::NEW, $product->getCondition());
        $this->assertSame('productPattern', $product->getPattern());
        $this->assertSame('wood', $product->getMaterial());
        $this->assertSame('brown', $product->getItemColor());
        $this->assertSame('xxl', $product->getItemSize());
        $this->assertSame('seoName', $product->getSeoName());
        $this->assertSame('https://www.example.com', $product->getCanonicalUrl());
        $this->assertSame(EnergyClassEnum::A_PLUS_PLUS_PLUS, $product->getEnergyClass());
        $this->assertSame('https://www.example.com/energy-label', $product->getEnergyClassPictureUrl());
        $this->assertSame('https://www.example.com/data-sheet', $product->getDataSheetUrl());
        $this->assertSame(GenderEnum::UNISEX, $product->getGender());
        $this->assertSame(AgeGroupEnum::KIDS, $product->getAgeGroup());
        $this->assertInstanceOf(Economicoperators::class, $product->getEconomicoperators());
        $this->assertInstanceOf(Skus::class, $product->getSkus());
        $this->assertInstanceOf(AddCatalogs::class, $product->getAddCatalogs());
        $this->assertInstanceOf(AddAttributes::class, $product->getAddAttributes());
        $this->assertInstanceOf(AddBaseProducts::class, $product->getAddBaseProducts());
        $this->assertCount(2, $product->getUseEbayVariations());
        $this->assertCount(4, $product->getPartsFitment());
        $this->assertCount(2, $product->getAdditionalPriceUpdates());
        $this->assertCount(3, $product->getAdditionalDescriptionFields());
        $this->assertCount(0, $product->getProductPictures());
        $this->assertCount(2, $product->getFeatures());
    }
}
