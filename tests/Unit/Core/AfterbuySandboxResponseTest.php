<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Core;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\AfterbuySandboxResponse;

class AfterbuySandboxResponseTest extends TestCase
{
    public function testGetStatusCodeReturnsValueFromConstructor(): void
    {
        $response = new AfterbuySandboxResponse('test', 201);
        $this->assertSame(201, $response->getStatusCode());
    }

    public function testGetHeadersReturnsHeadersArray(): void
    {
        $headers = [
            'Content-Type' => 'application/json',
            'X-Test' => '1',
        ];
        $response = new AfterbuySandboxResponse('irrelevant', 200, $headers);
        $this->assertSame($headers, $response->getHeaders());
    }

    public function testGetContentReturnsContentFromConstructor(): void
    {
        $response = new AfterbuySandboxResponse('response-content');
        $this->assertSame('response-content', $response->getContent());
    }

    public function testToArrayReturnsEmptyArray(): void
    {
        $response = new AfterbuySandboxResponse('foo');
        $this->assertSame([], $response->toArray());
    }

    public function testCancelDoesNotThrow(): void
    {
        $response = new AfterbuySandboxResponse('test');
        $this->expectNotToPerformAssertions();
        $response->cancel();
    }

    public function testGetInfoReturnsNull(): void
    {
        $response = new AfterbuySandboxResponse('test');
        $this->assertNull($response->getInfo());
        $this->assertNull($response->getInfo('some-type'));
    }
}
