<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetShopCatalogs\Catalog;
use Wundii\AfterbuySdk\Dto\GetShopCatalogs\Catalogs;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalog as UpdateCatalog;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\CatalogId;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\Level;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\RangeCatalogId;
use Wundii\AfterbuySdk\Filter\GetShopCatalogs\RangeLevel;
use Wundii\AfterbuySdk\Request\GetShopCatalogsRequest;
use Wundii\AfterbuySdk\Response\GetShopCatalogsResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetShopCatalogsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {

        $afterbuyGlobal = new AfterbuyGlobal('account', 'partner');
        $afterbuyGlobal->setEndpointEnum(EndpointEnum::SANDBOX);

        return $afterbuyGlobal;
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopCatalogsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetShopCatalogsRequest(detailLevelEnum: DetailLevelEnum::SECOND);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>2</DetailLevel>', $payload);

        $request = new GetShopCatalogsRequest(detailLevelEnum: [DetailLevelEnum::THIRD]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);
    }

    public function testMaxCatalogs(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopCatalogsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxCatalogs>100</MaxCatalogs>', $payload);

        $request = new GetShopCatalogsRequest(maxCatalogs: 50);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxCatalogs>50</MaxCatalogs>', $payload);
    }

    public function testFilter(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopCatalogsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('<DataFilter>', $payload);

        $request = new GetShopCatalogsRequest(filter: [
            new CatalogId(1),
            new Level(0),
            new RangeCatalogId(1, 10),
            new RangeLevel(0, 2),
        ]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DataFilter>', $payload);
        $this->assertStringContainsString('</DataFilter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>CatalogID</FilterName><FilterValues><FilterValue>1</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Level</FilterName><FilterValues><FilterValue>0</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>RangeID</FilterName><FilterValues><ValueFrom>1</ValueFrom><ValueTo>10</ValueTo></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>RangeLevel</FilterName><FilterValues><ValueFrom>0</ValueFrom><ValueTo>2</ValueTo></FilterValues></Filter>', $payload);
    }

    public function testShopCatalogsBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShopCatalogsSuccess.xml';

        $request = new GetShopCatalogsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Catalogs $catalogs */
        $catalogs = $response->getResult();

        $expected = new Catalogs(
            hasMoreCatalogs: false,
            catalogs: [
                new Catalog(
                    catalogId: 1010101,
                    name: 'TestName',
                    level: 0,
                    position: 0,
                    description: 'Testbeschreibung',
                    parnetId: 0,
                    additionalText: 'Zusatztext',
                    show: true,
                    picture1: 'picture1.jpg',
                    picture2: 'picture2.jpg',
                    titlePicture: 'picture3.jpg',
                    catalogProducts: [
                        1737852,
                        1915685,
                    ],
                ),
                new Catalog(
                    catalogId: 1110101,
                    name: 'TestName1',
                    level: 0,
                    position: 0,
                    description: 'Testbeschreibung1',
                    parnetId: 0,
                    additionalText: 'Zusatztext1',
                    show: true,
                ),
            ],
            lastCatalogId: 1110101,
        );

        $this->assertInstanceOf(GetShopCatalogsResponse::class, $response);
        $this->assertEquals($expected, $catalogs);
    }

    public function testShopCatalogsSerializeToUpdateCatalogs(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShopCatalogsSuccess.xml';

        $request = new GetShopCatalogsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Catalogs $catalogs */
        $catalogs = $response->getResult();

        $this->assertInstanceOf(Catalogs::class, $catalogs);

        $updatedCatalogs = $catalogs->serializeToUpdateCatalogs();

        $this->assertCount(2, $updatedCatalogs);
        $this->assertInstanceOf(UpdateCatalog::class, $updatedCatalogs[0]);
    }
}
