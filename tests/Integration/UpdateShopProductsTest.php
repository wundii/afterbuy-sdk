<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
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
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\ScaledDiscount;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Skus;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Variation;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\VariationValue;
use Wundii\AfterbuySdk\Enum\AgeGroupEnum;
use Wundii\AfterbuySdk\Enum\AttributTypEnum;
use Wundii\AfterbuySdk\Enum\BasePriceFactorEnum;
use Wundii\AfterbuySdk\Enum\ConditionEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\CountryOfOriginEnum;
use Wundii\AfterbuySdk\Enum\EnergyClassEnum;
use Wundii\AfterbuySdk\Enum\GenderEnum;
use Wundii\AfterbuySdk\Enum\PropertyNameEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionAddBaseProductEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionAddCatalogsEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionAttributesEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionEconomicoperatorsEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionSkusEnum;
use Wundii\AfterbuySdk\Interface\RequestDtoInterface;
use Wundii\AfterbuySdk\Request\UpdateShopProductsRequest;
use Wundii\AfterbuySdk\Response\UpdateShopProductsResponse;
use Wundii\AfterbuySdk\Tests\DomFormatter;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class UpdateShopProductsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner', EndpointEnum::SANDBOX);
    }

    public function validate(RequestDtoInterface $afterbuyAppendContent): array
    {
        $errors = [];
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $validator = $afterbuy->getValidator();

        $constraintViolationList = $validator->validate($afterbuyAppendContent);

        foreach ($constraintViolationList as $error) {
            $errors[] = sprintf('%s: %s', $error->getPropertyPath(), $error->getMessage());
        }

        return $errors;
    }

    public function testValidateMaxProducts(): void
    {
        $products = array_map(fn ($i) => new Product(new ProductIdent('validate'), (string) ($i + 1)), range(0, 250));
        $this->assertCount(251, $products);

        $request = new UpdateShopProductsRequest(
            $products,
        );

        $errors = $this->validate($request->requestDto());
        $expected = [
            'products: This collection should contain 250 elements or less.',
        ];

        $this->assertEquals($expected, $errors);
    }

    public function testValidateMaxSkus(): void
    {
        $request = new UpdateShopProductsRequest(
            [
                new Product(
                    new ProductIdent('test'),
                    name: 'test',
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
                            'NewSKU11',
                        ],
                    ),
                ),
            ],
        );

        $errors = $this->validate($request->requestDto());
        $expected = [
            'products[0].skus.skus: This collection should contain 10 elements or less.',
        ];

        $this->assertEquals($expected, $errors);
    }

    public function testValidateMaxAdditionalDescriptionFields(): void
    {
        $additionalDescriptionFields = array_map(fn ($i) => new AdditionalDescriptionField(($i + 1)), range(0, 10));
        $this->assertCount(11, $additionalDescriptionFields);

        $request = new UpdateShopProductsRequest(
            [
                new Product(new ProductIdent('test'), name: 'test', additionalDescriptionFields: $additionalDescriptionFields),
            ],
        );

        $errors = $this->validate($request->requestDto());
        $expected = [
            'products[0].additionalDescriptionFields: This collection should contain 10 elements or less.',
        ];

        $this->assertEquals($expected, $errors);
    }

    public function testUpdateShopProductsRequestBasic(): void
    {
        $file = __DIR__ . '/RequestFiles/UpdateShopProductsBasic.xml';
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new UpdateShopProductsRequest(
            [
                new Product(
                    productIdent: new ProductIdent(
                        userProductId: '12345ABCD',
                        baseProductTypeEnum: null,
                        productInsert: true,
                        productId: 0,
                        anr: 0,
                    ),
                    name: 'ABInterfaceNew TestItem Warning',
                    ean: 'EAN',
                ),
                new Product(
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
                ),
            ]
        );
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($file);

        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));
    }

    public function testUpdateShopProductsResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateShopProductsSuccess.xml';

        $request = new UpdateShopProductsRequest(
            [
                new Product(
                    new ProductIdent('test'),
                    'ABInterfaceNew TestItem',
                ),
            ]
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);
        $result = $response->getResult();

        $this->assertInstanceOf(UpdateShopProductsResponse::class, $response);
        $this->assertCount(0, $result->getNewProducts());
        $this->assertCount(0, $response->getWarningMessages());
    }

    public function testUpdateShopProductsResponseCombination(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateShopProductsSuccessCombination.xml';

        $request = new UpdateShopProductsRequest(
            [
                new Product(
                    new ProductIdent('test'),
                    'ABInterfaceNew TestItem',
                ),
            ]
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);
        $result = $response->getResult();

        $this->assertInstanceOf(UpdateShopProductsResponse::class, $response);
        $this->assertCount(1, $result->getNewProducts());
        $this->assertCount(1, $response->getWarningMessages());
        $this->assertSame(4, $response->getWarningMessages()[0]->getWarningCode());
    }

    public function testUpdateShopProductsResponseWarning(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateShopProductsWarning.xml';

        $request = new UpdateShopProductsRequest(
            [
                new Product(
                    new ProductIdent('test'),
                    'ABInterfaceNew TestItem',
                ),
            ]
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);
        $result = $response->getResult();

        $this->assertInstanceOf(UpdateShopProductsResponse::class, $response);
        $this->assertCount(0, $result->getNewProducts());
        $this->assertCount(1, $response->getWarningMessages());
        $this->assertSame(3, $response->getWarningMessages()[0]->getWarningCode());
    }
}
