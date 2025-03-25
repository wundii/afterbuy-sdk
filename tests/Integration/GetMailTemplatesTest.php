<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\GetMailTemplates\MailTemplate;
use AfterbuySdk\Dto\GetMailTemplates\MailTemplates;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\GetMailTemplatesRequest;
use AfterbuySdk\Response\GetMailTemplatesResponse;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetMailTemplatesTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testDetailLevel(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetMailTemplatesRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);

        $request = new GetMailTemplatesRequest(DetailLevelEnum::SECOND);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>2</DetailLevel>', $payload);

        $request = new GetMailTemplatesRequest(DetailLevelEnum::THIRD);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>0</DetailLevel>', $payload);
    }

    public function testTemplateId(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new GetMailTemplatesRequest();
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringNotContainsString('TemplateID', $payload);

        $request = new GetMailTemplatesRequest(templateId: 1234);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<TemplateID>1234</TemplateID>', $payload);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ReflectionException
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testMailTemplatesBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetMailTemplatesSuccess.xml';

        $request = new GetMailTemplatesRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var MailTemplates $mailTemplates */
        $mailTemplates = $response->getResponse();

        $this->assertInstanceOf(GetMailTemplatesResponse::class, $response);
        $this->assertCount(4, $mailTemplates->getMailTemplates());
        $this->assertInstanceOf(MailTemplate::class, $mailTemplates->getMailTemplates()[0]);
    }
}
