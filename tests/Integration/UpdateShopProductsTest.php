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
use Wundii\AfterbuySdk\Enum\CountryOfOriginEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
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
                    new ProductIdent(
                        '12345ABCD',
                        null,
                        true,
                        0,
                        0,
                    ),
                    'ABInterfaceNew TestItem Warning',
                    ean: 'EAN',
                ),
                new Product(
                    new ProductIdent(
                        '12346ABCD',
                        null,
                        true,
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
