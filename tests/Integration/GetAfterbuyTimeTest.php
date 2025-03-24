<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetAfterbuyTime\AfterbuyTime;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\GetAfterbuyTimeRequest;
use AfterbuySdk\Response\GetAfterbuyTimeResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetAfterbuyTimeTest extends TestCase
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
    public function testDateTimeBasic(): void
    {
        $file = __DIR__ . '/Files/GetAfterbuyTimeSuccess.xml';

        $request = new GetAfterbuyTimeRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var AfterbuyTime $afterbuyTime */
        $afterbuyTime = $response->getResponse();

        $this->assertInstanceOf(GetAfterbuyTimeResponse::class, $response);
        $this->assertEquals('2024-07-20 11:50:06', $afterbuyTime->getAfterbuyTimeStamp()->format('Y-m-d H:i:s'));
        $this->assertEquals('2024-07-20 09:50:06', $afterbuyTime->getAfterbuyUniversalTimeStamp()->format('Y-m-d H:i:s'));
    }
}
