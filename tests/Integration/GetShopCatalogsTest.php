<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\Catalog;
use AfterbuySdk\Dto\Catalogs;
use AfterbuySdk\Enum\EndpointEnum;
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

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testShopCatalogsBasic(): void
    {
        $file = __DIR__ . '/Files/GetShopCatalogsSuccess.xml';

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
}
