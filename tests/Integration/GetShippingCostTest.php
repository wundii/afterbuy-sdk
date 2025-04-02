<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyError;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetShippingCost\ShippingInfo;
use AfterbuySdk\Dto\GetShippingCost\ShippingService;
use AfterbuySdk\Enum\CallStatusEnum;
use AfterbuySdk\Enum\CountryIsoEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\GetShippingCostRequest;
use AfterbuySdk\Response\GetShippingCostResponse;
use AfterbuySdk\Tests\DomFormatter;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetShippingCostTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testShippingInfo(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();
        $file = __DIR__ . '/RequestFiles/GetShippingCostWithProductId.xml';
        $shippingInfo = new ShippingInfo(
            123456,
            2,
            3,
            45,
        );

        $request = new GetShippingCostRequest($shippingInfo);
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($file);
        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));

        $shippingInfo = new ShippingInfo(
            [
                123456,
            ],
            2,
            3,
            45,
        );

        $request = new GetShippingCostRequest($shippingInfo);
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($file);
        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));

        $file = __DIR__ . '/RequestFiles/GetShippingCostWithProductIds.xml';
        $shippingInfo = new ShippingInfo(
            [
                123456,
                234567,
            ],
            2,
            3,
            45,
            CountryIsoEnum::GERMANY,
            'standard',
            '34567',
        );

        $request = new GetShippingCostRequest($shippingInfo);
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
    public function testShippingCostBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShippingCostSuccess.xml';
        $shippingInfo = new ShippingInfo(
            123456,
            2,
            3,
            45,
        );
        $request = new GetShippingCostRequest($shippingInfo);
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var ShippingService $shippingService */
        $shippingService = $response->getResult();

        $this->assertInstanceOf(GetShippingCostResponse::class, $response);
        $this->assertInstanceOf(ShippingService::class, $shippingService);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testShippingCostErrorCode27(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShippingCostErrorCode27.xml';

        $shippingInfo = new ShippingInfo(
            123456,
            2,
            3,
            45,
        );
        $request = new GetShippingCostRequest($shippingInfo);
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertEquals(CallStatusEnum::ERROR, $response->getCallStatus());
        $this->assertInstanceOf(GetShippingCostResponse::class, $response);
        $this->assertCount(1, $response->getErrorMessages());
        $this->assertInstanceOf(AfterbuyError::class, $response->getErrorMessages()[0]);
        $this->assertSame(27, $response->getErrorMessages()[0]->getErrorCode());

        /** @var ShippingService $shippingService */
        $shippingService = $response->getResult();

        $this->assertNull($shippingService);
    }
}
