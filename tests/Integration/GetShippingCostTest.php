<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyError;
use AfterbuySdk\Dto\AfterbuyErrorList;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetShippingCost\ShippingService;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\ShippingCountryEnum;
use AfterbuySdk\Filter\GetShippingCost\ShippingInfo;
use AfterbuySdk\Request\GetShippingCostRequest;
use AfterbuySdk\Response\AfterbuyErrorResponse;
use AfterbuySdk\Response\GetShippingCostResponse;
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
        $shippingInfo = new ShippingInfo(
            123456,
            2,
            3,
            45,
        );

        $request = new GetShippingCostRequest($shippingInfo);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<ShippingInfo>', $payload);
        $this->assertStringContainsString('</ShippingInfo>', $payload);
        $this->assertStringContainsString('<ProductID>123456</ProductID>', $payload);
        $this->assertStringContainsString('<ItemsCount>2</ItemsCount>', $payload);
        $this->assertStringContainsString('<ItemsWeight>3</ItemsWeight>', $payload);
        $this->assertStringContainsString('<ItemsPrice>45</ItemsPrice>', $payload);
        $this->assertStringNotContainsString('ShippingCountry', $payload);
        $this->assertStringNotContainsString('ShippingGroup', $payload);
        $this->assertStringNotContainsString('PostalCode', $payload);

        $shippingInfo = new ShippingInfo(
            [
                123456,
                234567,
            ],
            2,
            3,
            45,
            ShippingCountryEnum::DE,
            'standard',
            '34567',
        );

        $request = new GetShippingCostRequest($shippingInfo);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<ShippingInfo>', $payload);
        $this->assertStringContainsString('</ShippingInfo>', $payload);
        $this->assertStringContainsString('<Products><ProductID>123456</ProductID><ProductID>234567</ProductID></Products>', $payload);
        $this->assertStringContainsString('<ItemsCount>2</ItemsCount>', $payload);
        $this->assertStringContainsString('<ItemsWeight>3</ItemsWeight>', $payload);
        $this->assertStringContainsString('<ItemsPrice>45</ItemsPrice>', $payload);
        $this->assertStringContainsString('<ShippingCountry>DE</ShippingCountry>', $payload);
        $this->assertStringContainsString('<ShippingGroup>standard</ShippingGroup>', $payload);
        $this->assertStringContainsString('<PostalCode>34567</PostalCode>', $payload);
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
        $file = __DIR__ . '/Files/GetShippingCostSuccess.xml';
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
        $shippingService = $response->getResponse();

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
    public function testShopCatalogsErrorCode30(): void
    {
        $file = __DIR__ . '/Files/GetShippingCostErrorCode27.xml';

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

        /** @var AfterbuyErrorList $afterbuyErrorList */
        $afterbuyErrorList = $response->getResponse();

        $this->assertInstanceOf(AfterbuyErrorResponse::class, $response);
        $this->assertCount(1, $afterbuyErrorList->getErrorList());
        $this->assertInstanceOf(AfterbuyError::class, $afterbuyErrorList->getErrorList()[0]);
        $this->assertSame(27, $afterbuyErrorList->getErrorList()[0]->getErrorCode());
    }
}
