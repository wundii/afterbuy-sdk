<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\UserDefinedFlag;
use AfterbuySdk\Dto\UserDefinedFlags;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\GetUserDefinedFlagsRequest;
use AfterbuySdk\Response\GetUserDefinedFlagsResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

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
        $file = __DIR__ . '/Files/GetUserDefinedFlagsSuccess.xml';

        $request = new GetUserDefinedFlagsRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var UserDefinedFlags $userDefinedFlags */
        $userDefinedFlags = $response->getResponse();

        $this->assertInstanceOf(GetUserDefinedFlagsResponse::class, $response);
        $this->assertCount(6, $userDefinedFlags->getUserDefinedFlags());
        $this->assertInstanceOf(UserDefinedFlag::class, $userDefinedFlags->getUserDefinedFlags()[0]);
    }
}
