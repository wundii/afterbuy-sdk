<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Dto\AfterbuyError;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetTranslatedMailTemplate\TranslatedMailText;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Filter\GetTranslatedMailTemplate\TemplateId;
use Wundii\AfterbuySdk\Filter\GetTranslatedMailTemplate\TemplateName;
use Wundii\AfterbuySdk\Request\GetTranslatedMailTemplateRequest;
use Wundii\AfterbuySdk\Response\GetTranslatedMailTemplateResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

class GetTranslatedMailTemplateTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testOfferId(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetTranslatedMailTemplateRequest(1);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<OfferID>1</OfferID>', $payload);
    }

    public function testUseTemplate(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetTranslatedMailTemplateRequest(1);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('UseTemplate', $payload);

        $request = new GetTranslatedMailTemplateRequest(1, true);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<UseTemplate>1</UseTemplate>', $payload);

        $request = new GetTranslatedMailTemplateRequest(1, false);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<UseTemplate>0</UseTemplate>', $payload);
    }

    public function testTemplateText(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetTranslatedMailTemplateRequest(1);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('TemplateText', $payload);

        $request = new GetTranslatedMailTemplateRequest(1, templateText: 'text');
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<TemplateText>text</TemplateText>', $payload);
    }

    public function testFilter(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetTranslatedMailTemplateRequest(1);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('<DataFilter>', $payload);

        $request = new GetTranslatedMailTemplateRequest(1, filter: [
            new TemplateId(1),
            new TemplateName('Mail'),
        ]);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DataFilter>', $payload);
        $this->assertStringContainsString('</DataFilter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>TemplateID</FilterName><FilterValues><FilterValue>1</FilterValue></FilterValues></Filter>', $payload);
        $this->assertStringContainsString('<Filter><FilterName>TemplateName</FilterName><FilterValues><FilterValue>Mail</FilterValue></FilterValues></Filter>', $payload);
    }

    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testTranslatedMailTemplateBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetTranslatedMailTemplateSuccess.xml';

        $request = new GetTranslatedMailTemplateRequest(1);
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var TranslatedMailText $translatedMailText */
        $translatedMailText = $response->getResult();

        $expected = new TranslatedMailText(
            'Hallo Test',
            ' Hallo Herr Meier, ... ',
        );

        $this->assertInstanceOf(GetTranslatedMailTemplateResponse::class, $response);
        $this->assertEquals($expected, $translatedMailText);
    }

    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testShippingCostErrorCode27(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetTranslatedMailTemplateError37.xml';

        $request = new GetTranslatedMailTemplateRequest(123456);
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertEquals(CallStatusEnum::ERROR, $response->getCallStatus());
        $this->assertInstanceOf(GetTranslatedMailTemplateResponse::class, $response);
        $this->assertCount(1, $response->getErrorMessages());
        $this->assertInstanceOf(AfterbuyError::class, $response->getErrorMessages()[0]);
        $this->assertSame(37, $response->getErrorMessages()[0]->getErrorCode());

        /** @var TranslatedMailText $translatedMailText */
        $translatedMailText = $response->getResult();

        $this->assertNull($translatedMailText);
    }
}
