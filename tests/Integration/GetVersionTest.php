<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetVersion\Version;
use AfterbuySdk\Dto\GetVersion\Versions;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\GetVersionRequest;
use AfterbuySdk\Response\GetVersionResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetVersionTest extends TestCase
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
    public function testVersionBasic(): void
    {
        $file = __DIR__ . '/Files/GetVersionSuccess.xml';

        $request = new GetVersionRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Versions $versions */
        $versions = $response->getResponse();

        $this->assertInstanceOf(GetVersionResponse::class, $response);
        $this->assertCount(1, $versions->getVersions());
        $this->assertInstanceOf(Version::class, $versions->getVersions()[0]);
    }
}
