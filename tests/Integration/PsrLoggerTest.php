<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Dto\AfterbuyError;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\AfterbuyWarning;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\ProductFilterEnum;
use Wundii\AfterbuySdk\Filter\GetStockInfo\ProductFilter;
use Wundii\AfterbuySdk\Request\GetListerHistoryRequest;
use Wundii\AfterbuySdk\Request\GetStockInfoRequest;
use Wundii\AfterbuySdk\Tests\DomFormatter;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockLogger;

class PsrLoggerTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testWithoutLogs(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetListerHistorySuccess.xml';

        $psrLogger = new MockLogger();
        $request = new GetListerHistoryRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX, $psrLogger);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertCount(0, $response->getErrorMessages());
        $this->assertCount(0, $response->getWarningMessages());
        $this->assertCount(0, $psrLogger->getLogger());
    }

    public function testWithWarning(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetStockInfoWarning.xml';
        $callStatusEnum = CallStatusEnum::WARNING;

        $psrLogger = new MockLogger();
        $request = new GetStockInfoRequest(productFilter: [new ProductFilter(ProductFilterEnum::ANR, 1)]);
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX, $psrLogger);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertCount(0, $response->getErrorMessages());
        $this->assertCount(1, $response->getWarningMessages());
        $this->assertInstanceOf(AfterbuyWarning::class, $response->getWarningMessages()[0]);

        $payload = '<?xml version="1.0" encoding="utf-8"?><Request><AfterbuyGlobal><AccountToken>account</AccountToken>';
        $payload .= '<PartnerToken>partner</PartnerToken><ErrorLanguage>DE</ErrorLanguage><CallName>GetStockInfo</CallName>';
        $payload .= '<DetailLevel>0</DetailLevel></AfterbuyGlobal><Products><Product><Anr>1</Anr></Product></Products></Request>';
        $payload = DomFormatter::xml($payload);

        $expected = [
            'message' => 'Afterbuy SDK Wundii\AfterbuySdk\Request\GetStockInfoRequest',
            'context' => [
                'uri' => 'http://api.afterbuy.de/afterbuy/ABInterface.aspx',
                'method' => 'GET',
                'payload' => $payload,
                'query' => [],
                'response' => [
                    'Code 2: Produkt nicht gefunden.',
                ],
            ],
        ];

        $this->assertCount(1, $psrLogger->getLogger());
        $this->assertCount(1, $psrLogger->getLoggerByLevel($callStatusEnum->getPsr3Level()));
        $warning = $psrLogger->getLoggerByLevel($callStatusEnum->getPsr3Level())[0];
        $warning['context']['payload'] = DomFormatter::xml($warning['context']['payload']);
        $this->assertEquals($expected, $warning);
    }

    public function testWithError(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetListerHistoryErrorCode30.xml';
        $callStatusEnum = CallStatusEnum::ERROR;

        $psrLogger = new MockLogger();
        $request = new GetListerHistoryRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX, $psrLogger);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertCount(1, $response->getErrorMessages());
        $this->assertCount(0, $response->getWarningMessages());
        $this->assertInstanceOf(AfterbuyError::class, $response->getErrorMessages()[0]);

        $payload = '<?xml version="1.0" encoding="utf-8"?><Request><AfterbuyGlobal><AccountToken>account</AccountToken>';
        $payload .= '<PartnerToken>partner</PartnerToken><ErrorLanguage>DE</ErrorLanguage><CallName>GetListerHistory</CallName>';
        $payload .= '<DetailLevel>0</DetailLevel></AfterbuyGlobal><MaxHistoryItems>100</MaxHistoryItems><DataFilter/></Request>';
        $payload = DomFormatter::xml($payload);

        $expected = [
            'message' => 'Afterbuy SDK Wundii\AfterbuySdk\Request\GetListerHistoryRequest',
            'context' => [
                'uri' => 'http://api.afterbuy.de/afterbuy/ABInterface.aspx',
                'method' => 'GET',
                'payload' => $payload,
                'query' => [],
                'response' => [
                    'Code 30: Kein gültiger Filter angegeben.',
                ],
            ],
        ];

        $this->assertCount(1, $psrLogger->getLogger());
        $this->assertCount(1, $psrLogger->getLoggerByLevel($callStatusEnum->getPsr3Level()));
        $warning = $psrLogger->getLoggerByLevel($callStatusEnum->getPsr3Level())[0];
        $warning['context']['payload'] = DomFormatter::xml($warning['context']['payload']);
        $this->assertEquals($expected, $warning);
    }
}
