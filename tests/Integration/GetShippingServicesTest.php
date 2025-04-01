<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetShippingServices\ShippingMethod;
use AfterbuySdk\Dto\GetShippingServices\ShippingService;
use AfterbuySdk\Dto\GetShippingServices\ShippingServices;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\GetShippingServicesRequest;
use AfterbuySdk\Response\GetShippingServicesResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetShippingServicesTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetShippingServicesRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetShippingServicesRequest(DetailLevelEnum::THIRD);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>4</DetailLevel>', $payload);

        $request = new GetShippingServicesRequest(DetailLevelEnum::FOURTH);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testShippingServicesBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShippingServicesSuccess.xml';

        $request = new GetShippingServicesRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var ShippingServices $shippingServices */
        $shippingServices = $response->getResult();

        $this->assertInstanceOf(GetShippingServicesResponse::class, $response);
        $this->assertCount(1, $shippingServices->getShippingServices());
        $this->assertInstanceOf(ShippingService::class, $shippingServices->getShippingServices()[0]);
        $this->assertCount(3, $shippingServices->getShippingServices()[0]->getShippingMethods());
        $this->assertInstanceOf(ShippingMethod::class, $shippingServices->getShippingServices()[0]->getShippingMethods()[0]);
    }
}
