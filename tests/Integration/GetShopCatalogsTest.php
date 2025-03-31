<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetShopCatalogs\Catalog;
use AfterbuySdk\Dto\GetShopCatalogs\Catalogs;
use AfterbuySdk\Dto\UpdateCatalogs\Catalog as UpdateCatalog;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Filter\GetShopCatalogs\CatalogId;
use AfterbuySdk\Filter\GetShopCatalogs\Level;
use AfterbuySdk\Filter\GetShopCatalogs\RangeCatalogId;
use AfterbuySdk\Filter\GetShopCatalogs\RangeLevel;
use AfterbuySdk\Request\GetShopCatalogsRequest;
use AfterbuySdk\Response\GetShopCatalogsResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetShopCatalogsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShopCatalogsRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetShopCatalogsRequest(DetailLevelEnum::SECOND);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>2</DetailLevel>', $payload);

        $request = new GetShopCatalogsRequest(DetailLevelEnum::THIRD);
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

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testShopCatalogsBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShopCatalogsSuccess.xml';

        $request = new GetShopCatalogsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Catalogs $catalogs */
        $catalogs = $response->getResponse();

        $this->assertInstanceOf(GetShopCatalogsResponse::class, $response);
        $this->assertCount(2, $catalogs->getCatalogs());
        $this->assertInstanceOf(Catalog::class, $catalogs->getCatalogs()[0]);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testShopCatalogsSerializeToUpdateCatalogs(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShopCatalogsSuccess.xml';

        $request = new GetShopCatalogsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Catalogs $catalogs */
        $catalogs = $response->getResponse();

        $this->assertInstanceOf(Catalogs::class, $catalogs);

        $updatedCatalogs = $catalogs->serializeToUpdateCatalogs();

        $this->assertCount(2, $updatedCatalogs);
        $this->assertInstanceOf(UpdateCatalog::class, $updatedCatalogs[0]);
    }
}
