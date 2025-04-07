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
use AfterbuySdk\Dto\UpdateShopProducts\AdditionalDescriptionField;
use AfterbuySdk\Dto\UpdateShopProducts\AdditionalPriceUpdate;
use AfterbuySdk\Dto\UpdateShopProducts\Economicoperators;
use AfterbuySdk\Dto\UpdateShopProducts\Feature;
use AfterbuySdk\Dto\UpdateShopProducts\PartsProperties;
use AfterbuySdk\Dto\UpdateShopProducts\PartsProperty;
use AfterbuySdk\Dto\UpdateShopProducts\Product;
use AfterbuySdk\Dto\UpdateShopProducts\ProductIdent;
use AfterbuySdk\Dto\UpdateShopProducts\ScaledDiscount;
use AfterbuySdk\Dto\UpdateShopProducts\Skus;
use AfterbuySdk\Dto\UpdateShopProducts\Variation;
use AfterbuySdk\Dto\UpdateShopProducts\VariationValue;
use AfterbuySdk\Enum\AgeGroupEnum;
use AfterbuySdk\Enum\AttributTypEnum;
use AfterbuySdk\Enum\BasePriceFactorEnum;
use AfterbuySdk\Enum\ConditionEnum;
use AfterbuySdk\Enum\CountryOfOriginEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\EnergyClassEnum;
use AfterbuySdk\Enum\GenderEnum;
use AfterbuySdk\Enum\PropertyNameEnum;
use AfterbuySdk\Enum\UpdateActionAddBaseProductEnum;
use AfterbuySdk\Enum\UpdateActionAddCatalogsEnum;
use AfterbuySdk\Enum\UpdateActionAttributesEnum;
use AfterbuySdk\Enum\UpdateActionEconomicoperatorsEnum;
use AfterbuySdk\Enum\UpdateActionSkusEnum;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
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

    public function validate(AfterbuyAppendXmlContentInterface $afterbuyAppendXmlContent): array
    {
        $errors = [];
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $validator = $afterbuy->getValidator();

        $constraintViolationList = $validator->validate($afterbuyAppendXmlContent);

        foreach ($constraintViolationList as $error) {
            $errors[] = sprintf('%s: %s', $error->getPropertyPath(), $error->getMessage());
        }

        return $errors;
    }

    public function testValidateMaxProducts(): void
    {
        $products = array_map(fn ($i) => new Product(new ProductIdent(), (string) ($i + 1)), range(0, 250));
        $this->assertCount(251, $products);

        $request = new UpdateShopProductsRequest(
            $products,
        );

        $errors = $this->validate($request->requestClass());
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
                    new ProductIdent(),
                    name: 'test',
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
                            'NewSKU11',
                        ],
                    ),
                ),
            ],
        );

        $errors = $this->validate($request->requestClass());
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
                new Product(new ProductIdent(), name: 'test', additionalDescriptionFields: $additionalDescriptionFields),
            ],
        );

        $errors = $this->validate($request->requestClass());
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
                    123456,
                    '123ABC',
                    111,
                    333,
                    'C-B-A-Test',
                    'TestKurzbeschreibung',
                    'TestMemo',
                    'TestBeschreibung',
                    'TestKeywords',
                    10,
                    100,
                    20,
                    30,
                    true,
                    true,
                    true,
                    2.55,
                    BasePriceFactorEnum::LITER,
                    5,
                    1.23,
                    2.34,
                    3.45,
                    1000,
                    10000,
                    true,
                    [
                        new ScaledDiscount(1, 1.23, 2.34),
                        new ScaledDiscount(2, 2.34, 3.45),
                        new ScaledDiscount(3, 3.45, 4.56),
                    ],
                    16.5,
                    2.33,
                    'Lagerort 1',
                    'Lagerort 2',
                    'Lagerort 3',
                    'Lagerort 4',
                    CountryOfOriginEnum::GERMANY,
                    'TestSuchalias',
                    true,
                    true,
                    'Packstationtest',
                    'ShopGruppe',
                    141556,
                    'TestFreeValue1',
                    'TestFreeValue2',
                    'TestFreeValue3',
                    'TestFreeValue4',
                    'TestFreeValue5',
                    'TestFreeValue6',
                    'TestFreeValue7',
                    'TestFreeValue8',
                    'TestFreeValue9',
                    'TestFreeValue10',
                    '3 Tage',
                    'MyURLSmall',
                    'MyURLBig',
                    'alien.jpg',
                    '/9j/4AAQSkZJRgABAQAASABIAAD/Z',
                    'type',
                    'value',
                    'brand',
                    '12345',
                    'test',
                    ConditionEnum::NEW,
                    'productPattern',
                    'wood',
                    'brown',
                    'xxl',
                    'https://www.example.com',
                    EnergyClassEnum::A_PLUS_PLUS_PLUS,
                    'https://www.example.com/energy-label',
                    'https://www.example.com/data-sheet',
                    GenderEnum::UNISEX,
                    AgeGroupEnum::KIDS,
                    new Economicoperators(
                        UpdateActionEconomicoperatorsEnum::ADD,
                        [
                            10000,
                            10001,
                            10002,
                        ],
                    ),
                    [
                        'string',
                    ],
                    new Skus(
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
                    new AddCatalogs(
                        UpdateActionAddCatalogsEnum::UPDATE,
                        [
                            new AddCatalog(141556, 'MyNEW Katalog'),
                        ],
                    ),
                    new AddAttributes(
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
                    new AddBaseProducts(
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
                    [
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
                    [
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
                    [
                        new AdditionalPriceUpdate(
                            1,
                            123456,
                            1.23,
                        ),
                        new AdditionalPriceUpdate(
                            2,
                            234567,
                            2.34,
                        ),
                    ],
                    [
                        new AdditionalDescriptionField(
                            10,
                            'FieldNameIdent - 10',
                            'Name - 10',
                            'Label - 10',
                            'Content - 10',
                        ),
                        new AdditionalDescriptionField(
                            11,
                            'FieldNameIdent - 11',
                            'Name - 11',
                            'Label - 11',
                            'Content - 11',
                        ),
                        new AdditionalDescriptionField(
                            12,
                            'FieldNameIdent - 12',
                            'Name - 12',
                            'Label - 12',
                            'Content - 12',
                        ),
                    ],
                    [],
                    [
                        new Feature(
                            2000,
                            'TestFeature 1',
                        ),
                        new Feature(
                            2001,
                            'TestFeature 2',
                        ),
                    ],
                ),
            ]
        );
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($file);

        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));
    }

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
