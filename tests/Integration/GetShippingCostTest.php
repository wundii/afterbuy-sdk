<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Dto\AfterbuyError;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingInfo;
use Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingMethods;
use Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingService;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Request\GetShippingCostRequest;
use Wundii\AfterbuySdk\Response\GetShippingCostResponse;
use Wundii\AfterbuySdk\Tests\DomFormatter;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

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
            3.0,
            45.0,
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
            3.0,
            45.0,
            CountryIsoEnum::GERMANY,
            'standard',
            '34567',
        );

        $request = new GetShippingCostRequest($shippingInfo);
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($file);
        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));
    }

    public function testShippingCostBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShippingCostSuccess.xml';
        $shippingInfo = new ShippingInfo(
            123456,
            2,
            3.0,
            45.0,
        );
        $request = new GetShippingCostRequest($shippingInfo);
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var ShippingService $shippingService */
        $shippingService = $response->getResult();

        $expected = new ShippingService(
            'Afterbuy Express',
            '1',
            [
                new ShippingMethods(
                    1.00,
                    'NormalPaket 2',
                    475032,
                    19.00,
                    'Deutschland',
                ),
                new ShippingMethods(
                    10.95,
                    'NormalPaket',
                    430384,
                    19.00,
                    'Deutschland',
                ),
            ],
        );

        $this->assertInstanceOf(GetShippingCostResponse::class, $response);
        $this->assertInstanceOf(ShippingService::class, $shippingService);
        $this->assertEquals($expected, $shippingService);
    }

    public function testShippingCostErrorCode27(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShippingCostErrorCode27.xml';

        $shippingInfo = new ShippingInfo(
            123456,
            2,
            3.0,
            45.0,
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
