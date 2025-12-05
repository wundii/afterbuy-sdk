<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalog;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\CatalogNotDeleted;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\CatalogNotDeleteds;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\NewCatalog;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\NewCatalogs;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionCatalogsEnum;
use Wundii\AfterbuySdk\Interface\RequestDtoInterface;
use Wundii\AfterbuySdk\Request\UpdateCatalogsRequest;
use Wundii\AfterbuySdk\Response\UpdateCatalogsResponse;
use Wundii\AfterbuySdk\Tests\DomFormatter;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class UpdateCatalogsTest extends TestCase
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

    public function testValidateEmptyCatalogRequirements(): void
    {
        $this->expectExceptionMessage('CatalogId or CatalogName must be set');

        new Catalog();
    }

    public function testValidateMaxCatalogs(): void
    {
        $catalogs = array_map(fn ($i) => new Catalog($i + 1, 'Objekt ' . ($i + 1)), range(0, 50));
        $this->assertCount(51, $catalogs);

        $request = new UpdateCatalogsRequest(
            UpdateActionCatalogsEnum::CREATE,
            $catalogs,
        );

        $errors = $this->validate($request->requestDto());
        $expected = [
            'catalogs: This collection should contain 50 elements or less.',
        ];

        $this->assertEquals($expected, $errors);
    }

    public function testValidateUpdateActionEnumCreateRequirements(): void
    {
        $request = new UpdateCatalogsRequest(
            UpdateActionCatalogsEnum::CREATE,
            [
                new Catalog(catalogId: 1),
            ]
        );

        $errors = $this->validate($request->requestDto());
        $expected = [
            'catalogs[0].catalogName.getUpdateActionEnum: catalogName must not be empty, when creating a catalog.',
        ];

        $this->assertEquals($expected, $errors);
    }

    public function testValidateUpdateActionEnumRefreshRequirements(): void
    {
        $request = new UpdateCatalogsRequest(
            UpdateActionCatalogsEnum::REFRESH,
            [
                new Catalog(catalogName: 'Test'),
            ]
        );

        $errors = $this->validate($request->requestDto());
        $expected = [
            'catalogs[0].catalogId.getUpdateActionEnum: catalogId must not be empty, when refresh or delete a catalog.',
        ];

        $this->assertEquals($expected, $errors);
    }

    public function testValidateUpdateActionEnumDeleteRequirements(): void
    {
        $request = new UpdateCatalogsRequest(
            UpdateActionCatalogsEnum::DELETE,
            [
                new Catalog(catalogName: 'Test'),
            ]
        );

        $errors = $this->validate($request->requestDto());
        $expected = [
            'catalogs[0].catalogId.getUpdateActionEnum: catalogId must not be empty, when refresh or delete a catalog.',
        ];

        $this->assertEquals($expected, $errors);
    }

    public function testValidateCatalogDescription(): void
    {
        $loremIpsum255 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata';
        $loremIpsum260 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanc';

        $request = new UpdateCatalogsRequest(
            UpdateActionCatalogsEnum::REFRESH,
            [
                new Catalog(catalogId: 1, catalogDescription: $loremIpsum255),
            ]
        );

        $errors = $this->validate($request->requestDto());
        $this->assertEquals([], $errors);

        $request = new UpdateCatalogsRequest(
            UpdateActionCatalogsEnum::REFRESH,
            [
                new Catalog(catalogId: 1, catalogDescription: $loremIpsum260),
            ]
        );

        $errors = $this->validate($request->requestDto());
        $expected = [
            'catalogs[0].catalogDescription: This value is too long. It should have 255 characters or less.',
        ];
        $this->assertEquals($expected, $errors);
    }

    public function testUpdateCatalogsRequestCreate(): void
    {
        $file = __DIR__ . '/RequestFiles/UpdateCatalogsCreate.xml';
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new UpdateCatalogsRequest(
            UpdateActionCatalogsEnum::CREATE,
            [
                new Catalog(
                    1,
                    '1. Hauptkatalog',
                    'Das ist der erste Hauptkatalog & weitere',
                    'http://www.test.de/katalog',
                    0,
                    1,
                    'HK1',
                    true,
                    catalog: [
                        new Catalog(
                            3,
                            '1. Unterkatalog zum 1. Hauptkataolog',
                            'Das ist der erste Unterkatalog',
                            position: 1,
                            showCatalog: true,
                            catalog: [
                                new Catalog(
                                    4,
                                    '1. Unterkatalog zum 1. Unterkataolog',
                                    'Das ist der erste Unterkatalog des Unterkatalogs',
                                    position: 1,
                                    showCatalog: true,
                                ),
                            ]
                        ),
                        new Catalog(
                            5,
                            '2. Unterkatalog zum 1. Hauptkataolog',
                            'Das ist der zweite Unterkatalog',
                            position: 2,
                            showCatalog: true,
                        ),
                    ]
                ),
                new Catalog(
                    2,
                    '2. Hauptkatalog',
                ),
            ]
        );
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($file);

        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));
    }

    public function testUpdateCatalogsResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateCatalogsSuccess.xml';

        $request = new UpdateCatalogsRequest(UpdateActionCatalogsEnum::CREATE, [
            new Catalog(1, 'First'),
        ]);
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var NewCatalogs $newCatalogs */
        $newCatalogs = $response->getResult();

        $this->assertInstanceOf(UpdateCatalogsResponse::class, $response);
        $this->assertCount(0, $newCatalogs->getNewCatalogs());
    }

    public function testUpdateCatalogsNewCatalogsResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateCatalogsNewCatalogsSuccess.xml';

        $request = new UpdateCatalogsRequest(UpdateActionCatalogsEnum::CREATE, [
            new Catalog(1, 'First'),
        ]);
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var NewCatalogs $newCatalogs */
        $newCatalogs = $response->getResult();

        $this->assertInstanceOf(UpdateCatalogsResponse::class, $response);
        $this->assertCount(2, $newCatalogs->getNewCatalogs());

        $newCatalog = $newCatalogs->getNewCatalogs()[0];
        $this->assertInstanceOf(NewCatalog::class, $newCatalog);
        $this->assertSame(10001, $newCatalog->getCatalogId());
        $this->assertSame('1. Hauptkatalog', $newCatalog->getCatalogName());
        $this->assertSame(1, $newCatalog->getCatalogIdRequested());
        $this->assertCount(2, $newCatalog->getNewCatalog());
    }

    public function testCatalogsCatalogNotDeletedsResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateCatalogsCatalogNotDeletedsSuccess.xml';

        $request = new UpdateCatalogsRequest(UpdateActionCatalogsEnum::CREATE, [
            new Catalog(1, 'First'),
        ]);
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var CatalogNotDeleteds $catalogNotDeleteds */
        $catalogNotDeleteds = $response->getResult();

        $this->assertInstanceOf(UpdateCatalogsResponse::class, $response);
        $this->assertCount(2, $catalogNotDeleteds->getCatalogNotDeleteds());

        $catalogNotDeleted = $catalogNotDeleteds->getCatalogNotDeleteds()[0];
        $this->assertInstanceOf(CatalogNotDeleted::class, $catalogNotDeleted);
        $this->assertSame(10001, $catalogNotDeleted->getCatalogId());
        $this->assertSame('1. Hauptkatalog', $catalogNotDeleted->getCatalogName());
        $this->assertCount(2, $catalogNotDeleted->getCatalogNotDeleted());
    }

    public function testCatalogConstructor(): void
    {
        $catalog = new Catalog(
            catalogId: 1,
            catalogName: 'Katalog 1',
            catalogDescription: 'Beschreibung Katalog 1',
            additionalUrl: 'http://www.test.de/katalog1',
            position: 1,
            additionalText: 'KAT1',
            showCatalog: true,
            picture: 'img/katalog1.jpg',
            mouseOverPicture: 'img/katalog1_over.jpg',
            catalog: [
                new Catalog(
                    catalogId: 2,
                    catalogName: 'Unterkatalog 1',
                ),
            ],
        );

        $this->assertSame(1, $catalog->getCatalogId());
        $this->assertSame('Katalog 1', $catalog->getCatalogName());
        $this->assertSame('Beschreibung Katalog 1', $catalog->getCatalogDescription());
        $this->assertSame('http://www.test.de/katalog1', $catalog->getAdditionalUrl());
        $this->assertSame(1, $catalog->getPosition());
        $this->assertSame('KAT1', $catalog->getAdditionalText());
        $this->assertTrue($catalog->getShowCatalog());
        $this->assertSame('img/katalog1.jpg', $catalog->getPicture());
        $this->assertSame('img/katalog1_over.jpg', $catalog->getMouseOverPicture());

        $catalogs = $catalog->getCatalog();
        $this->assertCount(1, $catalogs);
        $this->assertInstanceOf(Catalog::class, $catalogs[0]);
    }

    public function testCatalogSetters(): void
    {
        $catalog = new Catalog(1, 'Katalog 1');
        $catalog->setCatalogDescription('Beschreibung Katalog 1');
        $catalog->setAdditionalUrl('http://www.test.de/katalog1');
        $catalog->setPosition(1);
        $catalog->setAdditionalText('KAT1');
        $catalog->setShowCatalog(true);
        $catalog->setPicture('img/katalog1.jpg');
        $catalog->setMouseOverPicture('img/katalog1_over.jpg');
        $catalog->setCatalog([
            new Catalog(
                catalogId: 2,
                catalogName: 'Unterkatalog 1',
            ),
        ]);

        $this->assertSame(1, $catalog->getCatalogId());
        $this->assertSame('Katalog 1', $catalog->getCatalogName());
        $this->assertSame('Beschreibung Katalog 1', $catalog->getCatalogDescription());
        $this->assertSame('http://www.test.de/katalog1', $catalog->getAdditionalUrl());
        $this->assertSame(1, $catalog->getPosition());
        $this->assertSame('KAT1', $catalog->getAdditionalText());
        $this->assertTrue($catalog->getShowCatalog());
        $this->assertSame('img/katalog1.jpg', $catalog->getPicture());
        $this->assertSame('img/katalog1_over.jpg', $catalog->getMouseOverPicture());

        $catalogs = $catalog->getCatalog();
        $this->assertCount(1, $catalogs);
        $this->assertInstanceOf(Catalog::class, $catalogs[0]);
    }
}
