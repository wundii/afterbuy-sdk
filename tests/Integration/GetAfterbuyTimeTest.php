<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetAfterbuyTime\AfterbuyTime;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Request\GetAfterbuyTimeRequest;
use Wundii\AfterbuySdk\Response\GetAfterbuyTimeResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetAfterbuyTimeTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testDateTimeBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetAfterbuyTimeSuccess.xml';

        $request = new GetAfterbuyTimeRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var AfterbuyTime $afterbuyTime */
        $afterbuyTime = $response->getResult();

        $this->assertInstanceOf(GetAfterbuyTimeResponse::class, $response);
        $this->assertEquals('2024-07-20 11:50:06', $afterbuyTime->getAfterbuyTimeStamp()->format('Y-m-d H:i:s'));
        $this->assertEquals('2024-07-20 09:50:06', $afterbuyTime->getAfterbuyUniversalTimeStamp()->format('Y-m-d H:i:s'));
    }
}
