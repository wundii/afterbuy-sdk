<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetPaymentServices\PaymentService;
use AfterbuySdk\Dto\GetPaymentServices\PaymentServices;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Filter\GetPaymentServices\Land;
use AfterbuySdk\Filter\GetPaymentServices\Plattform;
use AfterbuySdk\Filter\GetPaymentServices\ValueOfGoods;
use AfterbuySdk\Request\GetPaymentServicesRequest;
use AfterbuySdk\Response\GetPaymentServicesResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetPaymentServicesTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testFilter(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetPaymentServicesRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('<DataFilter>', $payload);

        $request = new GetPaymentServicesRequest(filter: [
            new Land('DE'),
            new Plattform('ebay'),
            new ValueOfGoods('1'),
        ]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DataFilter>', $payload);
        $this->assertStringContainsString('</DataFilter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Land</FilterName><FilterValues><FilterValue>DE</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>Plattform</FilterName><FilterValues><FilterValue>ebay</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>ValueOfGoods</FilterName><FilterValues><FilterValue>1</FilterValue></FilterValues></Filter>', $payload);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testPaymentServicesBasic(): void
    {
        $file = __DIR__ . '/Files/GetPaymentServicesSuccess.xml';

        $request = new GetPaymentServicesRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var PaymentServices $paymentServices */
        $paymentServices = $response->getResponse();

        $this->assertInstanceOf(GetPaymentServicesResponse::class, $response);
        $this->assertCount(2, $paymentServices->getResult());
        $this->assertInstanceOf(PaymentService::class, $paymentServices->getResult()[0]);
    }
}
