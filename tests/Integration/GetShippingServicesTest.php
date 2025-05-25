<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingMethod;
use Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingService;
use Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingServices;
use Wundii\AfterbuySdk\Dto\GetShippingServices\WeightDefinitions;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Request\GetShippingServicesRequest;
use Wundii\AfterbuySdk\Response\GetShippingServicesResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

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

    public function testShippingServicesBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetShippingServicesSuccess.xml';

        $request = new GetShippingServicesRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var ShippingServices $shippingServices */
        $shippingServices = $response->getResult();

        $expected = new ShippingServices(
            [
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
            ],
        );

        $this->assertInstanceOf(GetShippingServicesResponse::class, $response);
        $this->assertEquals($expected, $shippingServices);
    }
}
