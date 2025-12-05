<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingMethod;
use Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingService;
use Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingServices;
use Wundii\AfterbuySdk\Dto\GetShippingServices\WeightDefinitions;
use Wundii\AfterbuySdk\Enum\Core\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Request\GetShippingServicesRequest;
use Wundii\AfterbuySdk\Response\GetShippingServicesResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetShippingServicesTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner', EndpointEnum::SANDBOX);
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

    public function testShippingServicesBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShippingServicesSuccess.xml';

        $request = new GetShippingServicesRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var ShippingServices $shippingServices */
        $shippingServices = $response->getResult();

        $expectedShippingServices = [
            new ShippingService(
                'Afterbuy Express',
                '0',
                0,
                [
                    new ShippingMethod(
                        198416,
                        'NormalPaket',
                        '0',
                        '0',
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        new WeightDefinitions(
                            1.0,
                            4.0,
                            10.0,
                        )
                    ),
                    new ShippingMethod(
                        198417,
                        'KleinPaket',
                        '0',
                        '0',
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        new WeightDefinitions(
                            0.0,
                            2.0,
                            0.05,
                        )
                    ),
                    new ShippingMethod(
                        199473,
                        'Postfach - Packstation',
                        '0',
                        '0',
                        1,
                        19,
                        4.00,
                        5.90,
                        2.0,
                        3.0,
                        4.0,
                        new WeightDefinitions(
                            0.0,
                            3.0,
                            6.9,
                        )
                    ),
                ],
            ),
        ];
        $expected = new ShippingServices(
            $expectedShippingServices,
        );

        $this->assertInstanceOf(GetShippingServicesResponse::class, $response);
        $this->assertEquals($expected, $shippingServices);
        $this->assertEquals($expectedShippingServices, $shippingServices->getShippingServices());

        $shippingService = $shippingServices->getShippingServices()[0];
        $this->assertInstanceOf(ShippingService::class, $shippingService);
        $this->assertSame('Afterbuy Express', $shippingService->getName());
        $this->assertSame('0', $shippingService->getDisplayArea());
        $this->assertSame(0, $shippingService->getGroupPrio());
        $this->assertCount(3, $shippingService->getShippingMethods());

        $shippingMethod = $shippingService->getShippingMethods()[0];
        $this->assertInstanceOf(ShippingMethod::class, $shippingMethod);
        $this->assertSame(198416, $shippingMethod->getShippingMethodID());
        $this->assertSame('NormalPaket', $shippingMethod->getName());
        $this->assertSame('0', $shippingMethod->getCountryGroup());
        $this->assertSame('0', $shippingMethod->getCountryGroupCountries());
        $this->assertSame(0, $shippingMethod->getLevel());
        $this->assertSame(0.0, $shippingMethod->getTaxRate());
        $this->assertSame(0.0, $shippingMethod->getPriceFrom());
        $this->assertSame(0.0, $shippingMethod->getPriceTo());
        $this->assertSame(0.0, $shippingMethod->getIslandAdditionalCosts());
        $this->assertSame(0.0, $shippingMethod->getFreeShippingPriceFrom());
        $this->assertSame(0.0, $shippingMethod->getAdditionalItemCosts());

        $weightDefinitions = $shippingMethod->getWeightDefinitions();
        $this->assertInstanceOf(WeightDefinitions::class, $weightDefinitions);
        $this->assertSame(1.0, $weightDefinitions->getWeightFrom());
        $this->assertSame(4.0, $weightDefinitions->getWeightTo());
        $this->assertSame(10.0, $weightDefinitions->getPrice());
    }
}
