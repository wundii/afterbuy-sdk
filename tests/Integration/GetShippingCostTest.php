<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingInfo;
use Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingMethods;
use Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingService;
use Wundii\AfterbuySdk\Dto\ResponseError;
use Wundii\AfterbuySdk\Enum\Core\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Request\GetShippingCostRequest;
use Wundii\AfterbuySdk\Response\GetShippingCostResponse;
use Wundii\AfterbuySdk\Tests\DomFormatter;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetShippingCostTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner', EndpointEnum::SANDBOX);
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

        $this->assertSame([123456, 234567], $shippingInfo->getProductIDs());
        $this->assertSame(CountryIsoEnum::GERMANY, $shippingInfo->getShippingCountry());
        $this->assertSame('standard', $shippingInfo->getShippingGroup());
        $this->assertSame('34567', $shippingInfo->getPostalCode());
        $this->assertSame(2, $shippingInfo->getItemsCount());
        $this->assertSame(3.0, $shippingInfo->getItemsWeight());
        $this->assertSame(45.0, $shippingInfo->getItemsPrice());

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
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var ShippingService $shippingService */
        $shippingService = $response->getResult();

        $expectedShippingMethods = [
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
        ];
        $expected = new ShippingService(
            'Afterbuy Express',
            '1',
            $expectedShippingMethods,
        );

        $this->assertInstanceOf(GetShippingCostResponse::class, $response);
        $this->assertInstanceOf(ShippingService::class, $shippingService);
        $this->assertEquals($expected, $shippingService);
        $this->assertEquals('Afterbuy Express', $shippingService->getShippingServiceName());
        $this->assertEquals('1', $shippingService->getShippingServicePriority());

        $shippinggMethod = $shippingService->getShippingMethods()[0];
        $this->assertInstanceOf(ShippingMethods::class, $shippinggMethod);
        $this->assertEquals(1.00, $shippinggMethod->getShippingCost());
        $this->assertEquals('NormalPaket 2', $shippinggMethod->getShippingMethod());
        $this->assertEquals(475032, $shippinggMethod->getShippingMethodId());
        $this->assertEquals(19.00, $shippinggMethod->getShippingTaxRate());
        $this->assertEquals('Deutschland', $shippinggMethod->getShippingMethodDescription());
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
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertEquals(CallStatusEnum::ERROR, $response->getCallStatus());
        $this->assertInstanceOf(GetShippingCostResponse::class, $response);
        $this->assertCount(1, $response->getErrorMessages());
        $this->assertInstanceOf(ResponseError::class, $response->getErrorMessages()[0]);
        $this->assertSame(27, $response->getErrorMessages()[0]->getErrorCode());

        /** @var ShippingService $shippingService */
        $shippingService = $response->getResult();

        $this->assertNull($shippingService);
    }
}
