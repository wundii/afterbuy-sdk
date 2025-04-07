<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetUserDefinedFlags\UserDefinedFlag;
use Wundii\AfterbuySdk\Dto\GetUserDefinedFlags\UserDefinedFlags;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Request\GetUserDefinedFlagsRequest;
use Wundii\AfterbuySdk\Response\GetUserDefinedFlagsResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetUserDefinedFlagsTest extends TestCase
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
    public function testUserDefinedFlagsBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetUserDefinedFlagsSuccess.xml';

        $request = new GetUserDefinedFlagsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var UserDefinedFlags $userDefinedFlags */
        $userDefinedFlags = $response->getResult();

        $this->assertInstanceOf(GetUserDefinedFlagsResponse::class, $response);
        $this->assertCount(6, $userDefinedFlags->getUserDefinedFlags());
        $this->assertInstanceOf(UserDefinedFlag::class, $userDefinedFlags->getUserDefinedFlags()[0]);
    }
}
