<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetVersion\Version;
use Wundii\AfterbuySdk\Dto\GetVersion\Versions;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\AfterbuySdk\Request\GetVersionRequest;
use Wundii\AfterbuySdk\Response\GetVersionResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetVersionTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner', AfterbuyEndpointEnum::SANDBOX);
    }

    public function testVersionBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetVersionSuccess.xml';

        $request = new GetVersionRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var Versions $versions */
        $versions = $response->getResult();

        $this->assertInstanceOf(GetVersionResponse::class, $response);
        $this->assertCount(1, $versions->getVersions());
        $this->assertInstanceOf(Version::class, $versions->getVersions()[0]);
    }
}
