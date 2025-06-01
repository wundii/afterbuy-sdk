<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Extension;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Extension\HttpClientHelper;

class HttpClientHelperTest extends TestCase
{
    public function testPrepareUriWithBasicUrlAndQuery(): void
    {
        $url = 'https://api.example.com/test';
        $query = [
            'foo' => 'bar',
            'baz' => '42',
        ];

        $uri = HttpClientHelper::prepareUri($url, $query);

        $this->assertStringContainsString('https://api.example.com/test', $uri);
        $this->assertStringContainsString('foo=bar', $uri);
        $this->assertStringContainsString('baz=42', $uri);
        $this->assertStringContainsString('?', $uri);
    }

    public function testPrepareUriWithoutQuery(): void
    {
        $url = 'https://api.example.com/abc';
        $query = [];

        $uri = HttpClientHelper::prepareUri($url, $query);

        $this->assertEquals('https://api.example.com/abc', $uri);
    }

    public function testPrepareUriWithExistingQueryParamsInUrl(): void
    {
        $url = 'https://api.example.com/foo?bar=baz';
        $query = [
            'new' => 'param',
        ];

        $uri = HttpClientHelper::prepareUri($url, $query);

        $this->assertStringContainsString('bar=baz', $uri);
        $this->assertStringContainsString('new=param', $uri);
        $this->assertStringContainsString('?', $uri);
    }

    public function testPrepareUriWithSpecialParameter(): void
    {
        $url = 'https://api.example.com/foo/';
        $query = [
            'special' => 'bär?',
        ];

        $uri = HttpClientHelper::prepareUri($url, $query);

        $this->assertStringContainsString('special=b%C3%A4r%3F', $uri);
        $this->assertStringContainsString('?', $uri);
    }
}
