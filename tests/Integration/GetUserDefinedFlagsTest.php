<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetUserDefinedFlags\UserDefinedFlag;
use Wundii\AfterbuySdk\Dto\GetUserDefinedFlags\UserDefinedFlags;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Request\GetUserDefinedFlagsRequest;
use Wundii\AfterbuySdk\Response\GetUserDefinedFlagsResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetUserDefinedFlagsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner', EndpointEnum::SANDBOX);
    }

    public function testUserDefinedFlagsBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetUserDefinedFlagsSuccess.xml';

        $request = new GetUserDefinedFlagsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var UserDefinedFlags $userDefinedFlags */
        $userDefinedFlags = $response->getResult();

        $this->assertInstanceOf(GetUserDefinedFlagsResponse::class, $response);
        $this->assertCount(6, $userDefinedFlags->getUserDefinedFlags());

        $userDefinedFlag = $userDefinedFlags->getUserDefinedFlags()[0];
        $this->assertInstanceOf(UserDefinedFlag::class, $userDefinedFlag);
        $this->assertSame('Markierung 2', $userDefinedFlag->getName());
        $this->assertSame('#999966', $userDefinedFlag->getColor());
        $this->assertSame(1337, $userDefinedFlag->getFlagId());
    }

    public function testCreateConstructor(): void
    {
        $userDefinedFlag = new UserDefinedFlag(
            name: 'Test Flag',
            color: '#FF0000',
            flagId: 42,
        );

        $this->assertSame('Test Flag', $userDefinedFlag->getName());
        $this->assertSame('#FF0000', $userDefinedFlag->getColor());
        $this->assertSame(42, $userDefinedFlag->getFlagId());
    }
}
