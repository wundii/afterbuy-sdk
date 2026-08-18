<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Trait;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\ResponseInterface as HttpClientResponseInterface;
use Wundii\AfterbuySdk\Enum\Core\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Tests\MockClasses\MockResponseTrait;
use Wundii\DataMapper\DataMapper;

/**
 * A greedy quantifier matches from the first opening to the last closing tag,
 * so a second occurrence of the tag swallows the whole response and the call
 * status silently degrades to unknown.
 */
class ResponseTraitGreedyTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCallStatusIsReadWhenTheTagAppearsTwice(): void
    {
        $content = '<?xml version="1.0" encoding="utf-8"?><Afterbuy>'
            . '<CallStatus>Success</CallStatus>'
            . '<VersionID>8</VersionID>'
            . '<Result><Log><CallStatus>Error</CallStatus></Log></Result>'
            . '</Afterbuy>';

        $trait = $this->getMockResponseTrait($content);

        $this->assertSame(CallStatusEnum::SUCCESS, $trait->getCallStatus());
    }

    /**
     * A data field whose content happens to contain the tag must not break the
     * status detection either.
     *
     * @throws Exception
     */
    public function testCallStatusIsReadWhenADataFieldContainsTheTag(): void
    {
        $content = '<?xml version="1.0" encoding="utf-8"?><Afterbuy>'
            . '<CallStatus>Success</CallStatus>'
            . '<VersionID>8</VersionID>'
            . '<Result><Note><![CDATA[siehe <CallStatus>Error</CallStatus> im Handbuch]]></Note></Result>'
            . '</Afterbuy>';

        $trait = $this->getMockResponseTrait($content);

        $this->assertSame(CallStatusEnum::SUCCESS, $trait->getCallStatus());
    }

    /**
     * @throws Exception
     */
    public function testVersionIdIsReadWhenTheTagAppearsTwice(): void
    {
        $content = '<?xml version="1.0" encoding="utf-8"?><Afterbuy>'
            . '<CallStatus>Success</CallStatus>'
            . '<VersionID>8</VersionID>'
            . '<Result><Item><VersionID>99</VersionID></Item></Result>'
            . '</Afterbuy>';

        $trait = $this->getMockResponseTrait($content);

        $this->assertSame(8, $trait->getVersionId());
    }

    /**
     * @throws Exception
     */
    private function getMockResponseTrait(string $responseContent): MockResponseTrait
    {
        $dataMapper = $this->createMock(DataMapper::class);
        $httpClientResponse = $this->createMock(HttpClientResponseInterface::class);

        $httpClientResponse->method('getContent')
            ->with(false)
            ->willReturn($responseContent);

        return new MockResponseTrait($dataMapper, $httpClientResponse, EndpointEnum::SANDBOX);
    }
}
