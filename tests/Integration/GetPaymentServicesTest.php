<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetPaymentServices\PaymentService;
use Wundii\AfterbuySdk\Dto\GetPaymentServices\PaymentServices;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Filter\GetPaymentServices\Land;
use Wundii\AfterbuySdk\Filter\GetPaymentServices\Plattform;
use Wundii\AfterbuySdk\Filter\GetPaymentServices\ValueOfGoods;
use Wundii\AfterbuySdk\Request\GetPaymentServicesRequest;
use Wundii\AfterbuySdk\Response\GetPaymentServicesResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetPaymentServicesTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner', EndpointEnum::SANDBOX);
    }

    public function testFilter(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetPaymentServicesRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('<DataFilter>', $payload);

        $request = new GetPaymentServicesRequest(filter: [
            new Land(CountryIsoEnum::GERMANY),
            new Plattform('ebay'),
            new ValueOfGoods(54.99),
        ]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DataFilter>', $payload);
        $this->assertStringContainsString('</DataFilter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Land</FilterName><FilterValues><FilterValue>DE</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Plattform</FilterName><FilterValues><FilterValue>ebay</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>ValueOfGoods</FilterName><FilterValues><FilterValue>54,99</FilterValue></FilterValues></Filter>', $payload);
    }

    public function testPaymentServicesBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetPaymentServicesSuccess.xml';

        $request = new GetPaymentServicesRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var PaymentServices $paymentServices */
        $paymentServices = $response->getResult();

        $expectedPaymentServices = [
            new PaymentService(
                126376,
                1,
                'Nachname',
                'StandardText',
                6,
                0,
                0.0,
                0.0,
                9.5,
                95.0,
                'ebay',
                true,
                false,
                '0',
                '0',
            ),
            new PaymentService(
                107506,
                1,
                'Vorkasse/Überweisung',
                'Vorkasse/Überweisung',
                1,
                0,
                0.0,
                5.0,
                0.0,
                0.0,
                'shop',
                true,
                true,
                'D',
                'D',
            ),
        ];
        $expected = new PaymentServices(
            $expectedPaymentServices,
        );

        $this->assertInstanceOf(GetPaymentServicesResponse::class, $response);
        $this->assertEquals($expected, $paymentServices);
        $this->assertEquals($expectedPaymentServices, $paymentServices->getPaymentService());

        $firstService = $paymentServices->getPaymentService()[0];
        $this->assertInstanceOf(PaymentService::class, $firstService);
        $this->assertSame('0', $firstService->getCountryGroup());
        $this->assertFalse($firstService->isDefault());
        $this->assertSame(0, $firstService->getLevel());
        $this->assertSame(95.0, $firstService->getMaxAmount());
        $this->assertSame(9.5, $firstService->getMinAmount());
        $this->assertSame('Nachname', $firstService->getName());
        $this->assertSame(1, $firstService->getPaymentFunctionId());
        $this->assertSame(126376, $firstService->getPaymentId());
        $this->assertSame('ebay', $firstService->getPlattformName());
        $this->assertSame(6, $firstService->getPosition());
        $this->assertTrue($firstService->isStandardForAll());
        $this->assertSame('StandardText', $firstService->getStandardText());
        $this->assertSame(0.0, $firstService->getSurcharge());
        $this->assertSame(0.0, $firstService->getSurchargePercent());
        $this->assertSame('0', $firstService->getCountryGroupCountries());
    }
}
