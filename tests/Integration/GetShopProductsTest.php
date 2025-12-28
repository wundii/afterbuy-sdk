<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetShopProducts\AdditionalDescriptionField;
use Wundii\AfterbuySdk\Dto\GetShopProducts\AdditionalPrice;
use Wundii\AfterbuySdk\Dto\GetShopProducts\Attribut;
use Wundii\AfterbuySdk\Dto\GetShopProducts\BaseProduct;
use Wundii\AfterbuySdk\Dto\GetShopProducts\BaseProductsRelationData;
use Wundii\AfterbuySdk\Dto\GetShopProducts\EbayVariationData;
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
use Wundii\AfterbuySdk\Enum\AgeGroupEnum;
use Wundii\AfterbuySdk\Enum\BaseProductFlagEnum;
use Wundii\AfterbuySdk\Enum\ConditionEnum;
use Wundii\AfterbuySdk\Enum\Core\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Enum\CountryOfOriginEnum;
use Wundii\AfterbuySdk\Enum\DateFilterShopProductsEnum;
use Wundii\AfterbuySdk\Enum\DefaultFilterShopProductsEnum;
use Wundii\AfterbuySdk\Enum\EnergyClassEnum;
use Wundii\AfterbuySdk\Enum\GenderEnum;
use Wundii\AfterbuySdk\Enum\PropertyNameEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
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
        return new AfterbuyGlobal('account', 'partner', EndpointEnum::SANDBOX);
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
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
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
                    baseProducts: [
                        new BaseProduct(
                            baseProductID: 123,
                            baseProductType: 456,
                            baseProductsRelationData: new BaseProductsRelationData(
                                quantity: 2,
                                variationLabel: 'Size: M; Color: Red',
                                defaultProduct: 'defaultProduct',
                                position: 1,
                                ebayVariationData: new EbayVariationData(
                                    ebayVariationName: 'ebayVariationName',
                                    ebayVariationValue: 'ebayVariationValue',
                                ),
                            ),
                        ),
                    ],
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
                    ageGroupEnum: AgeGroupEnum::NEWBORNS,
                    genderEnum: GenderEnum::LADIES,
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
                                    propertyNameEnum: PropertyNameEnum::KType,
                                    propertyValue: '3313',
                                ),
                                new PartsProperty(
                                    propertyNameEnum: PropertyNameEnum::KType,
                                    propertyValue: '3313',
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
                                    propertyValue: '449',
                                ),
                            ]
                        ),
                        new PartsProperties(
                            partsProperty: [
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
                            ]
                        ),
                        new PartsProperties(
                            partsProperty: [
                                new PartsProperty(
                                    propertyNameEnum: PropertyNameEnum::KType,
                                    propertyValue: '3315',
                                ),
                            ]
                        ),
                        new PartsProperties(
                            partsProperty: [
                                new PartsProperty(
                                    propertyNameEnum: PropertyNameEnum::KType,
                                    propertyValue: '3316',
                                ),
                                new PartsProperty(
                                    propertyNameEnum: PropertyNameEnum::HSN,
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

        $this->assertTrue($products->hasMoreProducts());
        $this->assertEquals(1010101, $products->getLastProductId());
        $this->assertCount(1, $products->getProducts());
        $this->assertEquals('https://www.afterbuy.de/', $products->getShippingServicesList());

        $paginationResult = $products->getPaginationResult();
        $this->assertInstanceOf(PaginationResult::class, $paginationResult);
        $this->assertEquals(1, $paginationResult->getItemsPerPage());
        $this->assertEquals(1, $paginationResult->getPageNumber());
        $this->assertEquals(1, $paginationResult->getTotalNumberOfEntries());
        $this->assertEquals(1, $paginationResult->getTotalNumberOfPages());

        $product = $products->getProducts()[0];
        $this->assertInstanceOf(Product::class, $product);
        $this->assertSame(1010101, $product->getProductId());
        $this->assertSame(101010110, $product->getAnr());
        $this->assertSame('Afterbuy Testartikel', $product->getName());
        $this->assertEquals(new DateTime('2025-05-19 16:12:23'), $product->getModDate());
        $this->assertEquals(new DateTime('2006-05-12T12:00:00'), $product->getFullFilmentImport());
        $this->assertEquals(new DateTime('2024-01-02T22:33:44'), $product->getLastSale());
        $this->assertEquals(BaseProductFlagEnum::PRODUCT, $product->getBaseProductFlag());
        $this->assertEquals(CountryOfOriginEnum::GERMANY, $product->getCountryOfOrigin());
        $this->assertEquals(141556, $product->getCrossCatalogID());
        $this->assertEquals(ConditionEnum::NEW, $product->getCondition());
        $this->assertEquals(EnergyClassEnum::NO_CLASS, $product->getEnergyClass());
        $this->assertEquals(AgeGroupEnum::NEWBORNS, $product->getAgeGroup());
        $this->assertEquals(GenderEnum::LADIES, $product->getGender());
        $this->assertEquals('https://example.com/canonical', $product->getCanonicalUrl());
        $this->assertEquals('https://example.com/datasheet', $product->getDataSheetUrl());
        $this->assertEquals('Afterbuy', $product->getProductBrand());
        $this->assertEquals('CustomsTariffNumber', $product->getCustomsTariffNumber());
        $this->assertEquals('99999999999999', $product->getManufacturerPartNumber());
        $this->assertEquals('EAN', $product->getAmazonStandardProductIdType());
        $this->assertEquals('99999999999999', $product->getAmazonStandardProductIdValue());
        $this->assertEquals('EAN', $product->getManufacturerStandardProductIdType());
        $this->assertEquals('99999999999999', $product->getManufacturerStandardProductIdValue());
        $this->assertTrue($product->isFacebook());
        $this->assertEquals('save', $product->getGoogleProductCategory());
        $this->assertEquals('adwordsGrouping', $product->getAdwordsGrouping());
        $this->assertEquals('pattern', $product->getPattern());
        $this->assertEquals('Metall', $product->getMaterial());
        $this->assertEquals('itemColor', $product->getItemColor());
        $this->assertEquals('itemSize', $product->getItemSize());
        $this->assertEquals('cl0', $product->getCustomLabel0());
        $this->assertEquals('cl1', $product->getCustomLabel1());
        $this->assertEquals('cl2', $product->getCustomLabel2());
        $this->assertEquals('cl3', $product->getCustomLabel3());
        $this->assertEquals('cl4', $product->getCustomLabel4());
        $this->assertEquals('FV1', $product->getFreeValue1());
        $this->assertEquals('FV2', $product->getFreeValue2());
        $this->assertEquals('FV3', $product->getFreeValue3());
        $this->assertEquals('FV4', $product->getFreeValue4());
        $this->assertEquals('FV5', $product->getFreeValue5());
        $this->assertEquals('FV6', $product->getFreeValue6());
        $this->assertEquals('FV7', $product->getFreeValue7());
        $this->assertEquals('FV8', $product->getFreeValue8());
        $this->assertEquals('FV9', $product->getFreeValue9());
        $this->assertEquals('FV10', $product->getFreeValue10());
        $this->assertEquals('1-3 Tage', $product->getDeliveryTime());
        $this->assertEquals('Lagerort 1', $product->getStocklocation_1());
        $this->assertEquals('Lagerort 2', $product->getStocklocation_2());
        $this->assertEquals('Lagerort 3', $product->getStocklocation_3());
        $this->assertEquals('Lagerort 4', $product->getStocklocation_4());
        $this->assertEquals('Packstationtest', $product->getShippingGroup());
        $this->assertEquals('1', $product->getShopShippingGroup());
        $this->assertEquals('searchEngineShipping', $product->getSearchEngineShipping());
        $this->assertTrue($product->isFroogle());
        $this->assertTrue($product->isKelkoo());
        $this->assertTrue($product->isDiscontinued());
        $this->assertTrue($product->isMergeStock());
        $this->assertTrue($product->isStock());
        $this->assertEquals(1, $product->getQuantity());
        $this->assertEquals(0, $product->getAuctionQuantity());
        $this->assertEquals(0, $product->getBasepriceFactor());
        $this->assertEquals(1, $product->getMinimumStock());
        $this->assertEquals(1, $product->getMinimumOrderQuantity());
        $this->assertEquals(0, $product->getFullFilmentQuantity());
        $this->assertEquals(0.0, $product->getSellingPrice());
        $this->assertEquals(0.0, $product->getBuyingPrice());
        $this->assertEquals(0.0, $product->getDealerPrice());
        $this->assertEquals(1000, $product->getLevel());
        $this->assertEquals(10000, $product->getPosition());
        $this->assertFalse($product->isTitleReplace());
        $this->assertEquals('Suchalias', $product->getSearchAlias());
        $this->assertEquals(19.0, $product->getTaxRate());
        $this->assertEquals(0.0, $product->getWeight());
        $this->assertEquals('https://example.com/small.jpg', $product->getImageSmallURL());
        $this->assertEquals('https://example.com/large.jpg', $product->getImageLargeURL());
        $this->assertCount(2, $product->getTags());
        $this->assertEquals('Tag1', $product->getTags()[0]);
        $this->assertEquals('Tag2', $product->getTags()[1]);
        $this->assertTrue($product->isAvailableShop());
        $this->assertSame('Kurzbeschreibung', $product->getShortDescription());
        $this->assertSame('Beschreibung', $product->getDescription());
        $this->assertSame('Mein Memo', $product->getMemo());
        $this->assertSame('1E2A3N', $product->getEan());
        $this->assertSame('Variation', $product->getVariationName());
        $this->assertSame('Afterbuy Testartikel', $product->getSeoName());
        $this->assertSame('googleBaseLabels', $product->getGoogleBaseLabels());
        $this->assertSame('headerDescriptionName', $product->getHeaderDescriptionName());
        $this->assertSame('headerDescriptionValue', $product->getHeaderDescriptionValue());
        $this->assertSame('footerDescriptionName', $product->getFooterDescriptionName());
        $this->assertSame('footerDescriptionValue', $product->getFooterDescriptionValue());
        $this->assertSame('Meine Keywords', $product->getKeywords());
        $this->assertSame('DE:Afterbuy Express', $product->getGoogleBaseShipping());
        $this->assertSame(null, $product->getShop20Id());
        $this->assertSame('Stk', $product->getUnitOfQuantity());
        $this->assertCount(3, $product->getSkus());
        $this->assertEquals('NewSKU1', $product->getSkus()[0]);
        $this->assertEquals('NewSKU2', $product->getSkus()[1]);
        $this->assertEquals('NewSKU3', $product->getSkus()[2]);
        $this->assertCount(1, $product->getCatalogs());
        $this->assertEquals(141556, $product->getCatalogs()[0]);

        $this->assertCount(1, $product->getProductPictures());
        $productPicture = $product->getProductPictures()[0];
        $this->assertInstanceOf(ProductPicture::class, $productPicture);
        $this->assertEquals(1, $productPicture->getNr());
        $this->assertEquals(0, $productPicture->getTyp());
        $this->assertEquals('http://bilder.afterbuy.de/images/NPNTRE/ProductPicture_1018331920_1.jpg', $productPicture->getUrl());
        $this->assertNull($productPicture->getAltText());
        $this->assertCount(3, $productPicture->getChilds());
        $productPictureChild = $productPicture->getChilds()[0];
        $this->assertInstanceOf(ProductPictureChild::class, $productPictureChild);
        $this->assertEquals(1, $productPictureChild->getNr());
        $this->assertEquals(1, $productPictureChild->getTyp());
        $this->assertEquals('http://bilder.afterbuy.de/images/NPNTRE/ProductPicture_1018331920_1_thumb.jpg', $productPictureChild->getUrl());

        $this->assertCount(3, $product->getScaledDiscounts());
        $scaledDiscount = $product->getScaledDiscounts()[0];
        $this->assertInstanceOf(ScaledDiscount::class, $scaledDiscount);
        $this->assertEquals(2, $scaledDiscount->getScaledQuantity());
        $this->assertEquals(1.2, $scaledDiscount->getScaledPrice());
        $this->assertEquals(1.1, $scaledDiscount->getScaledDPrice());

        $this->assertCount(2, $product->getFeatures());
        $feature = $product->getFeatures()[0];
        $this->assertInstanceOf(Feature::class, $feature);
        $this->assertEquals(1, $feature->getId());
        $this->assertEquals('Feature1', $feature->getName());
        $this->assertEquals('Value1', $feature->getValue());

        $this->assertCount(3, $product->getAttributes());
        $attribute = $product->getAttributes()[0];
        $this->assertInstanceOf(Attribut::class, $attribute);
        $this->assertEquals('Attribut 1', $attribute->getAttributName());
        $this->assertEquals('Dies ist ein Testattribut mit reinem Text', $attribute->getAttributWert());
        $this->assertEquals(0, $attribute->getAttributTyp());
        $this->assertFalse($attribute->isAttributRequired());

        $this->assertCount(4, $product->getPartsFitment());
        $partsProperties = $product->getPartsFitment()[0];
        $this->assertInstanceOf(PartsProperties::class, $partsProperties);
        $this->assertCount(5, $partsProperties->getPartsProperty());
        $partsProperty = $partsProperties->getPartsProperty()[0];
        $this->assertInstanceOf(PartsProperty::class, $partsProperty);
        $this->assertEquals(PropertyNameEnum::KType, $partsProperty->getPropertyName());
        $this->assertEquals('3313', $partsProperty->getPropertyValue());

        $this->assertCount(1, $product->getAdditionalDescriptionFields());
        $additionalDescriptionField = $product->getAdditionalDescriptionFields()[0];
        $this->assertInstanceOf(AdditionalDescriptionField::class, $additionalDescriptionField);
        $this->assertEquals(1, $additionalDescriptionField->getFieldId());
        $this->assertEquals('fieldName1', $additionalDescriptionField->getFieldName());
        $this->assertEquals('fieldLabel1', $additionalDescriptionField->getFieldLabel());
        $this->assertEquals('fieldContent1', $additionalDescriptionField->getFieldContent());

        $this->assertCount(1, $product->getAdditionalPrices());
        $additionalPrice = $product->getAdditionalPrices()[0];
        $this->assertInstanceOf(AdditionalPrice::class, $additionalPrice);
        $this->assertEquals(100, $additionalPrice->getDefinitionId());
        $this->assertEquals('Hood', $additionalPrice->getName());
        $this->assertEquals(1.2, $additionalPrice->getValue());
        $this->assertTrue($additionalPrice->getPretax());

        $this->assertCount(1, $product->getEconomicOperators());
        $economicOperator = $product->getEconomicOperators()[0];
        $this->assertInstanceOf(EconomicOperator::class, $economicOperator);
        $this->assertEquals('Muster GmbH', $economicOperator->getCompany());
        $this->assertEquals('Musterstrasse 1', $economicOperator->getStreet1());
        $this->assertEquals('Hinterhof', $economicOperator->getStreet2());
        $this->assertEquals('01234', $economicOperator->getPostalCode());
        $this->assertEquals('Musterstadt', $economicOperator->getCity());
        $this->assertEquals(CountryIsoEnum::GERMANY, $economicOperator->getCountry());
        $this->assertEquals('mail@example.com', $economicOperator->getEmail());
        $this->assertEquals('+0123456789', $economicOperator->getPhone());

        $this->assertCount(1, $product->getBaseProducts());
        $baseProduct = $product->getBaseProducts()[0];
        $this->assertInstanceOf(BaseProduct::class, $baseProduct);
        $this->assertEquals(123, $baseProduct->getBaseProductID());
        $this->assertEquals(456, $baseProduct->getBaseProductType());
        $baseProductsRelationData = $baseProduct->getBaseProductsRelationData();
        $this->assertInstanceOf(BaseProductsRelationData::class, $baseProductsRelationData);
        $this->assertEquals(2, $baseProductsRelationData->getQuantity());
        $this->assertEquals('Size: M; Color: Red', $baseProductsRelationData->getVariationLabel());
        $this->assertEquals('defaultProduct', $baseProductsRelationData->getDefaultProduct());
        $this->assertEquals(1, $baseProductsRelationData->getPosition());
        $ebayVariationData = $baseProductsRelationData->getEbayVariationData();
        $this->assertInstanceOf(EbayVariationData::class, $ebayVariationData);
        $this->assertEquals('ebayVariationName', $ebayVariationData->getEbayVariationName());
        $this->assertEquals('ebayVariationValue', $ebayVariationData->getEbayVariationValue());
    }
}
