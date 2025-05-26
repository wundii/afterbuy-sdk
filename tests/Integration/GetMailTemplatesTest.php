<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplate;
use Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplates;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Request\GetMailTemplatesRequest;
use Wundii\AfterbuySdk\Response\GetMailTemplatesResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;

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

        $request = new GetMailTemplatesRequest(detailLevelEnum: DetailLevelEnum::SECOND);
        $payload = $request->payload($afterbuyGlobal);
        $this->assertStringContainsString('<DetailLevel>2</DetailLevel>', $payload);

        $request = new GetMailTemplatesRequest(detailLevelEnum: [DetailLevelEnum::THIRD]);
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

    public function testMailTemplatesBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/GetMailTemplatesSuccess.xml';

        $request = new GetMailTemplatesRequest();
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        /** @var MailTemplates $mailTemplates */
        $mailTemplates = $response->getResult();

        $expected = new MailTemplates(
            [
                new MailTemplate(
                    202877,
                    'Mahnung1',
                    'Erinnerung an eBay Auktion(en): ... (abgeschnitten)',
                    'ErinnerungsTest',
                    true
                ),
                new MailTemplate(
                    202878,
                    'Mahnung2',
                    'Mahnung  eBay Auktion(en): ... (abgeschnitten)',
                    'MahnungsTest',
                    false
                ),
                new MailTemplate(
                    268297,
                    'BewertungsErinnerung',
                    'Sind Sie zufrieden mit Ihrem Auktionsgewinn ? ... (abgeschnitten)',
                    'BewertungsErinnerungTest',
                    false,
                ),
                new MailTemplate(
                    280085,
                    'rechnugstest',
                    'rechnungstest',
                    'rechnungstest',
                    false,
                ),
            ],
        );

        $this->assertInstanceOf(GetMailTemplatesResponse::class, $response);
        $this->assertCount(4, $mailTemplates->getMailTemplates());
        $this->assertInstanceOf(MailTemplate::class, $mailTemplates->getMailTemplates()[0]);
        $this->assertEquals($expected, $mailTemplates);
    }
}
