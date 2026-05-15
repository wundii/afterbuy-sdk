<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\CancelOrders\OrderCancellation;
use Wundii\AfterbuySdk\Enum\Core\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\StockBookingEnum;
use Wundii\AfterbuySdk\Interface\RequestDtoInterface;
use Wundii\AfterbuySdk\Request\CancelOrdersRequest;
use Wundii\AfterbuySdk\Response\CancelOrdersResponse;
use Wundii\AfterbuySdk\Tests\DomFormatter;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class CancelOrdersTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner', EndpointEnum::SANDBOX);
    }

    public function validate(RequestDtoInterface $afterbuyAppendContent): array
    {
        $errors = [];
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $validator = $afterbuy->getValidator();

        $constraintViolationList = $validator->validate($afterbuyAppendContent);

        foreach ($constraintViolationList as $error) {
            $errors[] = sprintf('%s: %s', $error->getPropertyPath(), $error->getMessage());
        }

        return $errors;
    }

    public function testValidateEmptyOrderCancellations(): void
    {
        $request = new CancelOrdersRequest();

        $errors = $this->validate($request->requestDto());
        $expected = [
            'orderCancellations: This collection should contain 1 element or more.',
        ];

        $this->assertEquals($expected, $errors);
    }

    public function testCancelOrdersRequestBasic(): void
    {
        $requestFile = __DIR__ . '/RequestFiles/CancelOrdersBasic.xml';
        $responseFile = __DIR__ . '/ResponseFiles/CancelOrdersSuccess.xml';

        $request = new CancelOrdersRequest(
            [
                new OrderCancellation(1234567),
            ]
        );

        $afterbuyGlobal = clone $this->afterbuyGlobal();
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($requestFile);
        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));

        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($responseFile), 200);
        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertInstanceOf(CancelOrdersResponse::class, $response);
        $this->assertEquals(CallStatusEnum::SUCCESS, $response->getCallStatus());
        $this->assertNull($response->getResult());
    }

    public function testCancelOrdersRequestMultiple(): void
    {
        $requestFile = __DIR__ . '/RequestFiles/CancelOrdersMultiple.xml';
        $responseFile = __DIR__ . '/ResponseFiles/CancelOrdersSuccess.xml';

        $request = new CancelOrdersRequest(
            [
                new OrderCancellation(1234567),
                new OrderCancellation(
                    2345678,
                    StockBookingEnum::AUCTION,
                    true,
                    -1,
                ),
            ]
        );

        $afterbuyGlobal = clone $this->afterbuyGlobal();
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($requestFile);
        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));

        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($responseFile), 200);
        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertInstanceOf(CancelOrdersResponse::class, $response);
        $this->assertEquals(CallStatusEnum::SUCCESS, $response->getCallStatus());
        $this->assertNull($response->getResult());
    }

    public function testCancelOrdersResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/CancelOrdersSuccess.xml';

        $request = new CancelOrdersRequest(
            [
                new OrderCancellation(1),
            ]
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertInstanceOf(CancelOrdersResponse::class, $response);
        $this->assertEquals(CallStatusEnum::SUCCESS, $response->getCallStatus());
        $this->assertNull($response->getResult());
    }
}
