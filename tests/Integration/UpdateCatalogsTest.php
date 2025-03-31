<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\UpdateCatalogs\Catalog;
use AfterbuySdk\Dto\UpdateCatalogs\CatalogNotDeleted;
use AfterbuySdk\Dto\UpdateCatalogs\CatalogNotDeleteds;
use AfterbuySdk\Dto\UpdateCatalogs\NewCatalog;
use AfterbuySdk\Dto\UpdateCatalogs\NewCatalogs;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\UpdateActionEnum;
use AfterbuySdk\Request\UpdateCatalogsRequest;
use AfterbuySdk\Response\UpdateCatalogsResponse;
use AfterbuySdk\Tests\DomFormatter;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class UpdateCatalogsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testValidateEmptyCatalogRequirements(): void
    {
        $this->expectExceptionMessage('CatalogId or CatalogName must be set');

        new Catalog();
    }

    public function testValidateMaxCatalogs(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $catalogs = array_map(fn($i) => new Catalog($i + 1, "Objekt " . ($i + 1)), range(0, 50));
        $this->assertCount(51, $catalogs);

        $request = new UpdateCatalogsRequest(
            UpdateActionEnum::CREATE,
            $catalogs,
        );

        $this->expectExceptionMessage('Catalogs can not contain more than 50 catalogs');
        $request->payload($afterbuyGlobal);
    }

    public function testValidateUpdateActionEnumCreateRequirements(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new UpdateCatalogsRequest(
            UpdateActionEnum::CREATE,
            [
                new Catalog(catalogId: 1),
            ]
        );

        $this->expectExceptionMessage('Catalog name cannot be null, when creating a catalog');
        $request->payload($afterbuyGlobal);
    }

    public function testValidateUpdateActionEnumRefreshRequirements(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new UpdateCatalogsRequest(
            UpdateActionEnum::REFRESH,
            [
                new Catalog(catalogName: 'Test'),
            ]
        );

        $this->expectExceptionMessage('Catalog id cannot be null, when updating or delete a catalog');
        $request->payload($afterbuyGlobal);
    }

    public function testValidateUpdateActionEnumDeleteRequirements(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new UpdateCatalogsRequest(
            UpdateActionEnum::DELETE,
            [
                new Catalog(catalogName: 'Test'),
            ]
        );

        $this->expectExceptionMessage('Catalog id cannot be null, when updating or delete a catalog');
        $request->payload($afterbuyGlobal);
    }

    public function testValidateCatalogDescription(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();
        $loremIpsum255 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata';
        $loremIpsum260 = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanc';

        $request = new UpdateCatalogsRequest(
            UpdateActionEnum::REFRESH,
            [
                new Catalog(catalogId: 1, catalogDescription: $loremIpsum255),
            ]
        );

        $this->assertTrue(true, 'No exception should be thrown');

        $request->payload($afterbuyGlobal);

        $request = new UpdateCatalogsRequest(
            UpdateActionEnum::REFRESH,
            [
                new Catalog(catalogId: 1, catalogDescription: $loremIpsum260),
            ]
        );

        $this->expectExceptionMessage('Catalog description cannot be longer than 255 characters');
        $request->payload($afterbuyGlobal);
    }

    public function testUpdateCatalogsRequestCreate(): void
    {
        $file = __DIR__ . '/RequestFiles/UpdateCatalogsCreate.xml';
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new UpdateCatalogsRequest(
            UpdateActionEnum::CREATE,
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

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testUpdateCatalogsNewCatalogsResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateCatalogsNewCatalogsSuccess.xml';

        $request = new UpdateCatalogsRequest(UpdateActionEnum::CREATE, [
            new Catalog(1, 'First'),
        ]);
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var NewCatalogs $newCatalogs */
        $newCatalogs = $response->getResponse();

        $this->assertInstanceOf(UpdateCatalogsResponse::class, $response);
        $this->assertCount(2, $newCatalogs->getNewCatalogs());
        $this->assertInstanceOf(NewCatalog::class, $newCatalogs->getNewCatalogs()[0]);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testCatalogsCatalogNotDeletedsResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateCatalogsCatalogNotDeletedsSuccess.xml';

        $request = new UpdateCatalogsRequest(UpdateActionEnum::CREATE, [
            new Catalog(1, 'First'),
        ]);
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var CatalogNotDeleteds $catalogNotDeleteds */
        $catalogNotDeleteds = $response->getResponse();

        $this->assertInstanceOf(UpdateCatalogsResponse::class, $response);
        $this->assertCount(2, $catalogNotDeleteds->getCatalogNotDeleteds());
        $this->assertInstanceOf(CatalogNotDeleted::class, $catalogNotDeleteds->getCatalogNotDeleteds()[0]);
    }
}
