<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\Catalog;
use AfterbuySdk\Dto\Catalogs;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\GetListerHistoryRequest;
use AfterbuySdk\Response\GetListerHistoryResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetListerHistoryTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetListerHistoryRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetListerHistoryRequest(DetailLevelEnum::SECOND);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>2</DetailLevel>', $payload);

        $request = new GetListerHistoryRequest(DetailLevelEnum::SIXTH);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);
    }

    public function testMaxCatalogs(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetListerHistoryRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxHistoryItems>100</MaxHistoryItems>', $payload);

        $request = new GetListerHistoryRequest(maxHistoryItems: 50);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<MaxHistoryItems>50</MaxHistoryItems>', $payload);
    }

    // public function testFilter(): void
    // {
    //     $afterbuyGlobal = clone $this->afterbuyGlobal();
    //
    //     $request = new GetListerHistoryRequest();
    //     $payload = $request->payload($afterbuyGlobal);
    //     $this->assertStringNotContainsString('<DataFilter>', $payload);
    //
    //     $request = new GetListerHistoryRequest(filter: [
    //         new CatalogID(1),
    //         new Level(0),
    //         new RangeCatalogId(1, 10),
    //         new RangeLevel(0, 2),
    //     ]);
    //     $payload = $request->payload($afterbuyGlobal);
    //     $this->assertStringContainsString('<DataFilter>', $payload);
    //     $this->assertStringContainsString('</DataFilter>', $payload);
    //     $this->assertStringContainsString('<Filter><FilterName>CatalogID</FilterName><FilterValues><FilterValue>1</FilterValue></FilterValues></Filter>', $payload);
    //     $this->assertStringContainsString('<Filter><FilterName>Level</FilterName><FilterValues><FilterValue>0</FilterValue></FilterValues></Filter>', $payload);
    //     $this->assertStringContainsString('<Filter><FilterName>RangeID</FilterName><FilterValues><ValueFrom>1</ValueFrom><ValueTo>10</ValueTo></FilterValues></Filter>', $payload);
    //     $this->assertStringContainsString('<Filter><FilterName>RangeLevel</FilterName><FilterValues><ValueFrom>0</ValueFrom><ValueTo>2</ValueTo></FilterValues></Filter>', $payload);
    // }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testShopCatalogsBasic(): void
    {
        $file = __DIR__ . '/Files/GetListerHistorySuccess.xml';

        $request = new GetListerHistoryRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Catalogs $catalogs */
        $catalogs = $response->getResponse();

        $this->assertInstanceOf(GetListerHistoryResponse::class, $response);
        $this->assertCount(2, $catalogs->getCatalogs());
        $this->assertInstanceOf(Catalog::class, $catalogs->getCatalogs()[0]);
    }
}
