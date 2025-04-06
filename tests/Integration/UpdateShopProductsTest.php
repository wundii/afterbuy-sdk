<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\UpdateShopProducts\AddAttribut;
use AfterbuySdk\Dto\UpdateShopProducts\AddAttributes;
use AfterbuySdk\Dto\UpdateShopProducts\AddBaseProduct;
use AfterbuySdk\Dto\UpdateShopProducts\AddBaseProducts;
use AfterbuySdk\Dto\UpdateShopProducts\AddCatalog;
use AfterbuySdk\Dto\UpdateShopProducts\AddCatalogs;
use AfterbuySdk\Dto\UpdateShopProducts\PartsProperties;
use AfterbuySdk\Dto\UpdateShopProducts\PartsProperty;
use AfterbuySdk\Dto\UpdateShopProducts\Product;
use AfterbuySdk\Dto\UpdateShopProducts\ProductIdent;
use AfterbuySdk\Dto\UpdateShopProducts\ScaledDiscount;
use AfterbuySdk\Dto\UpdateShopProducts\Skus;
use AfterbuySdk\Dto\UpdateShopProducts\Variation;
use AfterbuySdk\Dto\UpdateShopProducts\VariationValue;
use AfterbuySdk\Enum\AttributTypEnum;
use AfterbuySdk\Enum\BasePriceFactorEnum;
use AfterbuySdk\Enum\CountryOfOriginEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\PropertyNameEnum;
use AfterbuySdk\Enum\UpdateActionAddBaseProductEnum;
use AfterbuySdk\Enum\UpdateActionAddCatalogsEnum;
use AfterbuySdk\Enum\UpdateActionAttributesEnum;
use AfterbuySdk\Enum\UpdateActionSkusEnum;
use AfterbuySdk\Request\UpdateShopProductsRequest;
use AfterbuySdk\Response\UpdateShopProductsResponse;
use AfterbuySdk\Tests\DomFormatter;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;

class UpdateShopProductsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testValidateMaxProducts(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $products = array_map(fn ($i) => new Product(new ProductIdent(), (string) ($i + 1)), range(0, 250));
        $this->assertCount(251, $products);

        $request = new UpdateShopProductsRequest(
            $products,
        );

        $this->expectExceptionMessage('Products can not contain more than 250 products');
        $request->payload($afterbuyGlobal);
    }

    public function testUpdateShopProductsRequestBasic(): void
    {
        $file = __DIR__ . '/RequestFiles/UpdateShopProductsBasic.xml';
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new UpdateShopProductsRequest(
            [
                new Product(
                    new ProductIdent(
                        null,
                        true,
                        '12345ABCD',
                        0,
                        0,
                    ),
                    'ABInterfaceNew TestItem Warning',
                    ean: 'EAN',
                ),
                new Product(
                    new ProductIdent(
                        null,
                        true,
                        '12346ABCD',
                        0,
                        0,
                        'EAN',
                    ),
                    'ABInterfaceNew TestItem',
                    shortDescription: 'TestKurzbeschreibung',
                    memo: 'TestMemo',
                    description: 'TestBeschreibung',
                    keywords: 'TestKeywords',
                    quantity: 10,
                    auctionQuantity: 100,
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
                    imageSmallUrl: 'MyURLSmall',
                    imageLargeUrl: 'MyURLBig',
                    customsTariffNumber: '12345',
                    tags: ['string'],
                    skus: new Skus(
                        UpdateActionSkusEnum::ADD,
                        [
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
                        UpdateActionAddCatalogsEnum::UPDATE,
                        [
                            new AddCatalog(141556, 'MyNEW Katalog'),
                        ],
                    ),
                    addAttributes: new AddAttributes(
                        UpdateActionAttributesEnum::ADD_OR_UPDATE,
                        [
                            new AddAttribut(
                                'Attribut 5',
                                '1;2;3;4',
                                AttributTypEnum::DROPDOWN,
                                1000,
                                true,
                            ),
                        ],
                    ),
                    addBaseProducts: new AddBaseProducts(
                        UpdateActionAddBaseProductEnum::UPDATE,
                        [
                            new AddBaseProduct(
                                1234,
                                'TestLabel',
                                1000,
                                true,
                                3,
                            ),
                        ],
                    ),
                    useEbayVariations: [
                        new Variation(
                            'Grösse',
                            [
                                new VariationValue(
                                    123456789,
                                    'XXL',
                                    1,
                                    'https://www.afterbuy.de/homesites/images/home/logo.gif',
                                ),
                            ],
                        ),
                        new Variation(
                            'Farbe',
                            [
                                new VariationValue(
                                    123456789,
                                    'Blau',
                                    1,
                                    'https://www.afterbuy.de/homesites/images/home/logo.gif',
                                ),
                            ],
                        ),
                    ],
                    partsFitment: [
                        new PartsProperties(
                            [
                                new PartsProperty(
                                    PropertyNameEnum::KType,
                                    '3313',
                                ),
                                new PartsProperty(
                                    PropertyNameEnum::KType,
                                    '3314',
                                ),
                                new PartsProperty(
                                    PropertyNameEnum::HSN,
                                    '7107',
                                ),
                                new PartsProperty(
                                    PropertyNameEnum::TSN,
                                    '449',
                                ),
                                new PartsProperty(
                                    PropertyNameEnum::TSN,
                                    '450',
                                ),
                            ],
                        ),
                        new PartsProperties(
                            [
                                new PartsProperty(
                                    PropertyNameEnum::KType,
                                    '3314',
                                ),
                                new PartsProperty(
                                    PropertyNameEnum::HSN,
                                    '7107',
                                ),
                                new PartsProperty(
                                    PropertyNameEnum::TSN,
                                    '203',
                                ),
                            ],
                        ),
                        new PartsProperties(
                            [
                                new PartsProperty(
                                    PropertyNameEnum::KType,
                                    '3315',
                                ),
                            ],
                        ),
                        new PartsProperties(
                            [
                                new PartsProperty(
                                    PropertyNameEnum::KType,
                                    '3316',
                                ),
                                new PartsProperty(
                                    PropertyNameEnum::HSN,
                                    '',
                                ),
                            ],
                        ),
                    ],
                ),
            ]
        );
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($file);

        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));
    }
    //
    // public function testUpdateShopProductsRequestParcelLabel(): void
    // {
    //     $file = __DIR__ . '/RequestFiles/UpdateShopProductsParcelLabel.xml';
    //     $afterbuyGlobal = clone $this->afterbuyGlobal();
    //
    //     $request = new UpdateShopProductsRequest(
    //         [
    //             new Product(
    //                 12345600,
    //                 shippingInfo: new ShippingInfo(
    //                     parcelLabels: [
    //                         new ParcelLabel(12345600, 1, '0123DHL-1'),
    //                         new ParcelLabel(12345600, 5, '0123DHL-5'),
    //                         new ParcelLabel(12345601, 4, '0123DHL-4'),
    //                         new ParcelLabel(12345601, 5, '0123DHL-5'),
    //                         new ParcelLabel(12345602, 1, '0123DHL-1'),
    //                         new ParcelLabel(12345603, 2, '0123DHL-2'),
    //                         new ParcelLabel(12345603, 3, '0123DHL-3'),
    //                     ]
    //                 ),
    //             ),
    //         ]
    //     );
    //     $payload = $request->payload($afterbuyGlobal);
    //     $expected = file_get_contents($file);
    //
    //     $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));
    // }

    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testUpdateShopProductsResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateShopProductsSuccess.xml';

        $request = new UpdateShopProductsRequest(
            [
                new Product(
                    new ProductIdent(),
                    'ABInterfaceNew TestItem',
                ),
            ]
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);
        $result = $response->getResult();

        $this->assertInstanceOf(UpdateShopProductsResponse::class, $response);
        $this->assertCount(1, $result->getNewProducts());
        $this->assertCount(1, $response->getWarningMessages());
        $this->assertSame(4, $response->getWarningMessages()[0]->getWarningCode());
    }
}
