<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\PaymentService;
use AfterbuySdk\Dto\PaymentServices;
use AfterbuySdk\Enum\EndpointEnum;
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
