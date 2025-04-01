<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyError;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\AfterbuyWarning;
use AfterbuySdk\Enum\CallStatusEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\ProductFilterEnum;
use AfterbuySdk\Filter\GetStockInfo\ProductFilter;
use AfterbuySdk\Request\GetListerHistoryRequest;
use AfterbuySdk\Request\GetStockInfoRequest;
use AfterbuySdk\Tests\DomFormatter;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use AfterbuySdk\Tests\MockClasses\MockLogger;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class PsrLoggerTest extends TestCase
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

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
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
            'message' => 'Afterbuy SDK AfterbuySdk\Request\GetStockInfoRequest',
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

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
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
            'message' => 'Afterbuy SDK AfterbuySdk\Request\GetListerHistoryRequest',
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
