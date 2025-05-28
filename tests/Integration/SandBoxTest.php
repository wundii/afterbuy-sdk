<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalog;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionCatalogsEnum;
use Wundii\AfterbuySdk\Request\UpdateCatalogsRequest;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockLogger;

class SandBoxTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testSandboxWithDefaultResponse(): void
    {
        $psrLogger = new MockLogger();
        $request = new UpdateCatalogsRequest(
            UpdateActionCatalogsEnum::REFRESH,
            [
                new Catalog(
                    123,
                    'Testkatalog',
                ),
            ],
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX, $psrLogger);

        $response = $afterbuy->runRequest($request);

        $this->assertEquals(EndpointEnum::SANDBOX, $response->getEndpoint());
        $this->assertStringContainsString('sandbox="true"', $response->getXmlResponse());
        $this->assertCount(1, $psrLogger->getLogger());
    }

    public function testSandboxWithInjectedResponse(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateCatalogsSuccess.xml';

        $psrLogger = new MockLogger();
        $request = new UpdateCatalogsRequest(
            UpdateActionCatalogsEnum::REFRESH,
            [
                new Catalog(
                    123,
                    'Testkatalog',
                ),
            ],
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX, $psrLogger);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertEquals(EndpointEnum::SANDBOX, $response->getEndpoint());
        $this->assertStringNotContainsString('sandbox="true"', $response->getXmlResponse());
        $this->assertCount(0, $response->getErrorMessages());
        $this->assertCount(0, $response->getWarningMessages());
        $this->assertCount(0, $psrLogger->getLogger());
    }
}
