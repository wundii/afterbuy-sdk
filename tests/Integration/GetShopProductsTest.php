<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetShopProducts\AdditionalDescriptionField;
use Wundii\AfterbuySdk\Dto\GetShopProducts\AdditionalPrice;
use Wundii\AfterbuySdk\Dto\GetShopProducts\Attribut;
use Wundii\AfterbuySdk\Dto\GetShopProducts\EconomicOperator;
use Wundii\AfterbuySdk\Dto\GetShopProducts\Feature;
use Wundii\AfterbuySdk\Dto\GetShopProducts\PaginationResult;
use Wundii\AfterbuySdk\Dto\GetShopProducts\PartsProperties;
use Wundii\AfterbuySdk\Dto\GetShopProducts\PartsProperty;
use Wundii\AfterbuySdk\Dto\GetShopProducts\Product;
use Wundii\AfterbuySdk\Dto\GetShopProducts\ProductPicture;
use Wundii\AfterbuySdk\Dto\GetShopProducts\ProductPictureChild;
use Wundii\AfterbuySdk\Dto\GetShopProducts\Products;
use Wundii\AfterbuySdk\Dto\GetShopProducts\ScaledDiscount;
use Wundii\AfterbuySdk\Enum\BaseProductFlagEnum;
use Wundii\AfterbuySdk\Enum\ConditionEnum;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Enum\CountryOfOriginEnum;
use Wundii\AfterbuySdk\Enum\DateFilterShopProductsEnum;
use Wundii\AfterbuySdk\Enum\DefaultFilterShopProductsEnum;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\EnergyClassEnum;
use Wundii\AfterbuySdk\Extends\DateTime;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Anr;
use Wundii\AfterbuySdk\Filter\GetShopProducts\DateFilter;
use Wundii\AfterbuySdk\Filter\GetShopProducts\DefaultFilter;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Ean;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Level;
use Wundii\AfterbuySdk\Filter\GetShopProducts\ProductId;
use Wundii\AfterbuySdk\Filter\GetShopProducts\RangeAnr;
use Wundii\AfterbuySdk\Filter\GetShopProducts\RangeProductId;
use Wundii\AfterbuySdk\Filter\GetShopProducts\Tag;
use Wundii\AfterbuySdk\Request\GetShopProductsRequest;
use Wundii\AfterbuySdk\Response\GetShopProductsResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetShopProductsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetShopProductsRequest(detailLevelEnum: DetailLevelEnum::EIGHTH);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>128</DetailLevel>', $payload);

        $request = new GetShopProductsRequest(detailLevelEnum: [DetailLevelEnum::SIXTH]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);
    }

    public function testMaxShopItems(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxShopItems>100</MaxShopItems>', $payload);

        $request = new GetShopProductsRequest(maxShopItems: 50);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxShopItems>50</MaxShopItems>', $payload);

        $request = new GetShopProductsRequest(maxShopItems: 300);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxShopItems>250</MaxShopItems>', $payload);
    }

    public function testSuppressBaseProductRelatedData(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<SuppressBaseProductRelatedData>0</SuppressBaseProductRelatedData>', $payload);

        $request = new GetShopProductsRequest(suppressBaseProductRelatedData: true);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<SuppressBaseProductRelatedData>1</SuppressBaseProductRelatedData>', $payload);
    }

    public function testPaginationEnabled(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('PaginationEnabled', $payload);

        $request = new GetShopProductsRequest(paginationEnabled: true);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<PaginationEnabled>1</PaginationEnabled>', $payload);
    }

    public function testPageNumber(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('PageNumber', $payload);

        $request = new GetShopProductsRequest(pageNumber: 12);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<PageNumber>12</PageNumber>', $payload);
    }

    public function testReturnShop20Container(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('ReturnShop20Container', $payload);

        $request = new GetShopProductsRequest(returnShop20Container: true);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<ReturnShop20Container>1</ReturnShop20Container>', $payload);
    }

    public function testFilter(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopProductsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('<DataFilter>', $payload);

        $request = new GetShopProductsRequest(filter: [
            new ProductId(1),
            new Anr(2),
            new Ean('3'),
            new Tag('item'),
            new DefaultFilter(DefaultFilterShopProductsEnum::NOT_ALLSETS),
            new Level(0, 2),
            new RangeProductId(12, 34),
            new RangeAnr(56, 78),
            new DateFilter(new DateTime('2025-03-01'), new DateTime('2025-03-31'), DateFilterShopProductsEnum::MOD_DATE),
        ]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DataFilter>', $payload);
        $this->assertStringContainsString('</DataFilter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>ProductID</FilterName><FilterValues><FilterValue>1</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Anr</FilterName><FilterValues><FilterValue>2</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Ean</FilterName><FilterValues><FilterValue>3</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Tag</FilterName><FilterValues><FilterValue>item</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>DefaultFilter</FilterName><FilterValues><FilterValue>Not_AllSets</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Level</FilterName><FilterValues><LevelFrom>0</LevelFrom><LevelTo>2</LevelTo></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>RangeID</FilterName><FilterValues><ValueFrom>12</ValueFrom><ValueTo>34</ValueTo></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>RangeAnr</FilterName><FilterValues><ValueFrom>56</ValueFrom><ValueTo>78</ValueTo></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>DateFilter</FilterName><FilterValues><DateFrom>01.03.2025 00:00:00</DateFrom><DateTo>31.03.2025 00:00:00</DateTo><FilterValue>ModDate</FilterValue></FilterValues></Filter>', $payload);
    }

    public function testShopProductsBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShopProductsSuccess.xml';

        $request = new GetShopProductsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Products $products */
        $products = $response->getResult();

        $expected = new Products(
            hasMoreProducts: true,
            lastProductId: 1010101,
            products: [
                new Product(
                    shop20Id: null,
                    productId: 1010101,
                    anr: 101010110,
                    ean: '1E2A3N',
                    name: 'Afterbuy Testartikel',
                    seoName: 'Afterbuy Testartikel',
                    modDate: new DateTime('2025-05-19 16:12:23'),
                    variationName: 'Variation',
                    baseProductFlagEnum: BaseProductFlagEnum::PRODUCT,
                    baseProducts: [],
                    shortDescription: 'Kurzbeschreibung',
                    tags: [
                        'Tag1',
                        'Tag2',
                    ],
                    memo: 'Mein Memo',
                    googleBaseLabels: 'googleBaseLabels',
                    headerDescriptionName: 'headerDescriptionName',
                    headerDescriptionValue: 'headerDescriptionValue',
                    description: 'Beschreibung',
                    footerDescriptionName: 'footerDescriptionName',
                    footerDescriptionValue: 'footerDescriptionValue',
                    googleBaseShipping: 'DE:Afterbuy Express',
                    keywords: 'Meine Keywords',
                    quantity: 1,
                    availableShop: true,
                    auctionQuantity: 0,
                    stock: true,
                    discontinued: true,
                    mergeStock: true,
                    unitOfQuantity: 'Stk',
                    basepriceFactor: 0,
                    minimumStock: 1,
                    minimumOrderQuantity: 1,
                    fullFilmentQuantity: 0,
                    fullFilmentImport: new DateTime('2006-05-12T12:00:00'),
                    sellingPrice: 0.0,
                    buyingPrice: 0.0,
                    dealerPrice: 0.0,
                    level: 1000,
                    position: 10000,
                    titleReplace: false,
                    scaledDiscounts: [
                        new ScaledDiscount(
                            scaledQuantity: 2,
                            scaledPrice: 1.2,
                            scaledDPrice: 1.1,
                        ),
                        new ScaledDiscount(
                            scaledQuantity: 4,
                            scaledPrice: 0.0,
                            scaledDPrice: 0.0,
                        ),
                        new ScaledDiscount(
                            scaledQuantity: 5,
                            scaledPrice: 0.0,
                            scaledDPrice: 0.0,
                        ),
                    ],
                    taxRate: 19.0,
                    weight: 0.0,
                    searchAlias: 'Suchalias',
                    froogle: true,
                    kelkoo: true,
                    shippingGroup: 'Packstationtest',
                    shopShippingGroup: '1',
                    searchEngineShipping: 'searchEngineShipping',
                    crossCatalogID: 141556,
                    features: [
                        new Feature(
                            id: 1,
                            name: 'Feature1',
                            value: 'Value1',
                        ),
                        new Feature(
                            id: 2,
                            name: 'Feature2',
                            value: 'Value2',
                        ),
                    ],
                    freeValue1: 'FV1',
                    freeValue2: 'FV2',
                    freeValue3: 'FV3',
                    freeValue4: 'FV4',
                    freeValue5: 'FV5',
                    freeValue6: 'FV6',
                    freeValue7: 'FV7',
                    freeValue8: 'FV8',
                    freeValue9: 'FV9',
                    freeValue10: 'FV10',
                    deliveryTime: '1-3 Tage',
                    stocklocation_1: 'Lagerort 1',
                    stocklocation_2: 'Lagerort 2',
                    stocklocation_3: 'Lagerort 3',
                    stocklocation_4: 'Lagerort 4',
                    countryOfOriginEnum: CountryOfOriginEnum::GERMANY,
                    lastSale: new DateTime('2024-01-02T22:33:44'),
                    imageSmallURL: 'https://example.com/small.jpg',
                    imageLargeURL: 'https://example.com/large.jpg',
                    amazonStandardProductIdType: 'EAN',
                    amazonStandardProductIdValue: '99999999999999',
                    manufacturerStandardProductIdType: 'EAN',
                    manufacturerStandardProductIdValue: '99999999999999',
                    productBrand: 'Afterbuy',
                    customsTariffNumber: 'CustomsTariffNumber',
                    manufacturerPartNumber: '99999999999999',
                    facebook: true,
                    googleProductCategory: 'save',
                    adwordsGrouping: 'adwordsGrouping',
                    conditionEnum: ConditionEnum::NEW,
                    ageGroup: 0,
                    gender: 0,
                    pattern: 'pattern',
                    material: 'Metall',
                    itemColor: 'itemColor',
                    itemSize: 'itemSize',
                    customLabel0: 'cl0',
                    customLabel1: 'cl1',
                    customLabel2: 'cl2',
                    customLabel3: 'cl3',
                    customLabel4: 'cl4',
                    canonicalUrl: 'https://example.com/canonical',
                    energyClassEnum: EnergyClassEnum::NO_CLASS,
                    dataSheetUrl: 'https://example.com/datasheet',
                    skus: [
                        'NewSKU1',
                        'NewSKU2',
                        'NewSKU3',
                    ],
                    productPictures: [
                        new ProductPicture(
                            nr: 1,
                            typ: 0,
                            url: 'http://bilder.afterbuy.de/images/NPNTRE/ProductPicture_1018331920_1.jpg',
                            altText: null,
                            childs: [
                                new ProductPictureChild(
                                    nr: 1,
                                    typ: 1,
                                    url: 'http://bilder.afterbuy.de/images/NPNTRE/ProductPicture_1018331920_1_thumb.jpg',
                                ),
                                new ProductPictureChild(
                                    nr: 1,
                                    typ: 2,
                                    url: 'http://bilder.afterbuy.de/images/NPNTRE/ProductPicture_1018331920_1_zoom.jpg',
                                ),
                                new ProductPictureChild(
                                    nr: 1,
                                    typ: 3,
                                    url: 'http://bilder.afterbuy.de/images/NPNTRE/ProductPicture_1018331920_1_list.jpg',
                                ),
                            ],
                        ),
                    ],
                    catalogs: [
                        141556,
                    ],
                    attributes: [
                        new Attribut(
                            attributName: 'Attribut 1',
                            attributWert: 'Dies ist ein Testattribut mit reinem Text',
                            attributTyp: 0,
                            attributRequired: false,
                        ),
                        new Attribut(
                            attributName: 'Attribut 4',
                            attributWert: ';1. Wahl;2. Wahl;3. Wahl;4. Wahl',
                            attributTyp: 2,
                            attributRequired: false,
                        ),
                        new Attribut(
                            attributName: 'Attribut 5',
                            attributWert: 'http://www.afterbuy.de',
                            attributTyp: 3,
                            attributRequired: true,
                        ),
                    ],
                    partsFitment: [
                        new PartsProperties(
                            partsProperty: [
                                new PartsProperty(
                                    propertyName: 'KType',
                                    propertyValue: '3313',
                                ),
                                new PartsProperty(
                                    propertyName: 'KType2',
                                    propertyValue: '3313',
                                ),
                                new PartsProperty(
                                    propertyName: 'HSN',
                                    propertyValue: '7107',
                                ),
                                new PartsProperty(
                                    propertyName: 'TSN',
                                    propertyValue: '449',
                                ),
                                new PartsProperty(
                                    propertyName: 'TSN',
                                    propertyValue: '449',
                                ),
                            ]
                        ),
                        new PartsProperties(
                            partsProperty: [
                                new PartsProperty(
                                    propertyName: 'KType',
                                    propertyValue: '3314',
                                ),
                                new PartsProperty(
                                    propertyName: 'HSN',
                                    propertyValue: '7107',
                                ),
                                new PartsProperty(
                                    propertyName: 'TSN',
                                    propertyValue: '203',
                                ),
                            ]
                        ),
                        new PartsProperties(
                            partsProperty: [
                                new PartsProperty(
                                    propertyName: 'KType',
                                    propertyValue: '3315',
                                ),
                            ]
                        ),
                        new PartsProperties(
                            partsProperty: [
                                new PartsProperty(
                                    propertyName: 'KType',
                                    propertyValue: '3316',
                                ),
                                new PartsProperty(
                                    propertyName: 'HSN',
                                    propertyValue: '',
                                ),
                            ]
                        ),
                    ],
                    additionalDescriptionFields: [
                        new AdditionalDescriptionField(
                            fieldId: 1,
                            fieldName: 'fieldName1',
                            fieldLabel: 'fieldLabel1',
                            fieldContent: 'fieldContent1',
                        ),
                    ],
                    additionalPrices: [
                        new AdditionalPrice(
                            definitionId: 100,
                            name: 'Hood',
                            value: 1.2,
                            pretax: true,
                        ),
                    ],
                    economicOperators: [
                        new EconomicOperator(
                            company: 'Muster GmbH',
                            street1: 'Musterstrasse 1',
                            street2: 'Hinterhof',
                            postalCode: '01234',
                            city: 'Musterstadt',
                            countryIsoEnum: CountryIsoEnum::GERMANY,
                            email: 'mail@example.com',
                            phone: '+0123456789',
                        ),
                    ],
                ),
            ],
            shippingServicesList: 'https://www.afterbuy.de/',
            paginationResult: new PaginationResult(
                1,
                1,
                1,
                1,
            ),
        );

        $this->assertInstanceOf(GetShopProductsResponse::class, $response);
        $this->assertEquals($expected, $products);
    }
}
