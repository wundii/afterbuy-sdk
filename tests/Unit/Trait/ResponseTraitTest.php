<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Trait;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface as HttpClientResponseInterface;
use Wundii\AfterbuySdk\Dto\ResponseError;
use Wundii\AfterbuySdk\Dto\ResponseErrorList;
use Wundii\AfterbuySdk\Dto\ResponseWarning;
use Wundii\AfterbuySdk\Dto\ResponseWarningList;
use Wundii\AfterbuySdk\Enum\Core\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Tests\MockClasses\MockResponseTrait;
use Wundii\DataMapper\DataMapper;

class ResponseTraitTest extends TestCase
{
    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testConvertErrorXmlToAfterbuyFormatWithValidErrorXml()
    {
        $trait = $this->getMockResponseTrait('<root></root>');

        $errorXml = file_get_contents(__DIR__ . '/Files/ConvertErrorXmlSource.xml');

        $resultXml = $trait->convertErrorXmlToAfterbuyFormat($errorXml);

        $expectedXml = file_get_contents(__DIR__ . '/Files/ConvertErrorXmlExpected.xml');

        $this->assertEquals($expectedXml, $resultXml);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testGetStatusCodeDelegatesToHttpClientResponse()
    {
        $trait = $this->getMockResponseTrait('<CallStatus>Success</CallStatus><VersionID>5</VersionID>');
        $this->assertSame(200, $trait->getStatusCode());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testGetInfoDelegatesToHttpClientResponse()
    {
        $trait = $this->getMockResponseTrait('<CallStatus>Success</CallStatus><VersionID>5</VersionID>');
        $this->assertSame('the info', $trait->getInfo());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testGetCallStatusParsesSuccess()
    {
        $xml = '<CallStatus>Success</CallStatus><VersionID>3</VersionID>';
        $trait = $this->getMockResponseTrait($xml);
        $this->assertEquals(CallStatusEnum::SUCCESS, $trait->getCallStatus());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testGetVersionId()
    {
        $xml = '<CallStatus>Success</CallStatus><VersionID>42</VersionID>';
        $trait = $this->getMockResponseTrait($xml);
        $this->assertSame(42, $trait->getVersionId());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testGetEndpointReturnsEndpoint()
    {
        $trait = $this->getMockResponseTrait('<CallStatus>Success</CallStatus><VersionID>1</VersionID>');
        $this->assertEquals(EndpointEnum::SANDBOX, $trait->getEndpoint());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testGetXmlResponseReturnsRawXml()
    {
        $xml = '<CallStatus>Success</CallStatus><VersionID>3</VersionID>';
        $trait = $this->getMockResponseTrait($xml);
        $this->assertEquals($xml, $trait->getXmlResponse());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testGetErrorMessagesReturnsArrayFromErrorList()
    {
        $error = new ResponseError(2, 'Fehler', 'Lang');
        $errorList = new ResponseErrorList([$error]);
        $xml = '<CallStatus>Error</CallStatus><VersionID>1</VersionID>';
        $trait = $this->getMockResponseTrait($xml, errorList: $errorList);
        $this->assertEquals(CallStatusEnum::ERROR, $trait->getCallStatus());
        $this->assertCount(1, $trait->getErrorMessages());
        $this->assertSame($error, $trait->getErrorMessages()[0]);
        $this->assertTrue($trait->hasErrors());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testGetWarningMessagesReturnsArrayFromWarningList()
    {
        $warning = new ResponseWarning(1, 'Warnung', 'Lang');
        $warningList = new ResponseWarningList([$warning]);
        $xml = '<CallStatus>Warning</CallStatus><VersionID>1</VersionID>';
        $trait = $this->getMockResponseTrait($xml, warningList: $warningList);
        $this->assertEquals(CallStatusEnum::WARNING, $trait->getCallStatus());
        $this->assertCount(1, $trait->getWarningMessages());
        $this->assertInstanceOf(ResponseWarning::class, $trait->getWarningMessages()[0]);
        $this->assertTrue($trait->hasWarnings());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testHasErrorsReturnsFalseIfNoErrorList()
    {
        $trait = $this->getMockResponseTrait('<CallStatus>Success</CallStatus><VersionID>1</VersionID>');
        $this->assertFalse($trait->hasErrors());

        $trait = $this->getMockResponseTrait('<success>1</success>');
        $this->assertFalse($trait->hasErrors());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testHasWarningsReturnsFalseIfNoWarningList()
    {
        $trait = $this->getMockResponseTrait('<CallStatus>Success</CallStatus><VersionID>1</VersionID>');
        $this->assertFalse($trait->hasWarnings());

        $trait = $this->getMockResponseTrait('<success>1</success>');
        $this->assertFalse($trait->hasWarnings());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    private function getMockResponseTrait(
        string $responseContent,
        ?ResponseErrorList $errorList = null,
        ?ResponseWarningList $warningList = null,
    ): MockResponseTrait {
        $dataMapper = $this->createMock(DataMapper::class);
        $httpClientResponse = $this->createMock(HttpClientResponseInterface::class);

        $httpClientResponse->method('getContent')
            ->with(false)
            ->willReturn($responseContent);

        $httpClientResponse->method('getStatusCode')
            ->willReturn(200);

        $httpClientResponse->method('getInfo')
            ->willReturn('the info');

        if ($errorList !== null) {
            $dataMapper->method('xml')
                ->willReturn($errorList);
        }

        if ($warningList !== null) {
            $dataMapper->method('xml')
                ->willReturn($warningList);
        }

        return new MockResponseTrait($dataMapper, $httpClientResponse, EndpointEnum::SANDBOX);
    }
}
