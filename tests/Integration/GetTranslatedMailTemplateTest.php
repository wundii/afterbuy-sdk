<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetTranslatedMailTemplate\TranslatedMailText;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Filter\GetTranslatedMailTemplate\TemplateId;
use AfterbuySdk\Filter\GetTranslatedMailTemplate\TemplateName;
use AfterbuySdk\Request\GetTranslatedMailTemplateRequest;
use AfterbuySdk\Response\GetTranslatedMailTemplateResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

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
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
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
        $translatedMailText = $response->getResponse();

        $this->assertInstanceOf(GetTranslatedMailTemplateResponse::class, $response);
        $this->assertSame('Hallo Herr Meier, ...', $translatedMailText->getTranslatedMailText());
    }
}
