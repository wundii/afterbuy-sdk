<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Extension;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\FilterInterface;
use Wundii\AfterbuySdk\Interface\ProductFilterInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

class SimpleXMLExtendTest extends TestCase
{
    public function newDocument(): SimpleXMLExtend
    {
        return new SimpleXMLExtend('<Root></Root>');
    }

    public function testAddNumberWithInt(): void
    {
        $xml = $this->newDocument();
        $xml->addNumber('TestKey', 123);

        $this->assertXmlStringEqualsXmlString(
            '<Root><TestKey>123</TestKey></Root>',
            $xml->asXML()
        );
    }

    public function testAddNumberWithFloat(): void
    {
        $xml = $this->newDocument();
        $xml->addNumber('FloatKey', 42.5);

        $this->assertStringContainsString('<FloatKey>42,50</FloatKey>', $xml->asXML());
    }

    public function testAddNumberWithNull(): void
    {
        $xml = $this->newDocument();
        $xml->addNumber('NullKey', null);

        $this->assertXmlStringEqualsXmlString('<Root/>', $xml->asXML());
    }

    public function testAddStringNormal(): void
    {
        $xml = $this->newDocument();
        $xml->addString('Hello', 'World');

        $this->assertXmlStringEqualsXmlString(
            '<Root><Hello>World</Hello></Root>',
            $xml->asXML()
        );
    }

    public function testAddStringWithSpecialChars(): void
    {
        $xml = $this->newDocument();
        $xml->addString('WithSpecial', 'foo<bar>&baz');

        $xmlString = $xml->asXML();
        $this->assertStringContainsString('<WithSpecial><![CDATA[foo<bar>&baz]]></WithSpecial>', $xmlString);
    }

    public function testAddStringWithNull(): void
    {
        $xml = $this->newDocument();
        $xml->addString('NullStr', null);

        $this->assertXmlStringEqualsXmlString('<Root/>', $xml->asXML());
    }

    public function testAddBoolTrue(): void
    {
        $xml = $this->newDocument();
        $xml->addBool('IsTrue', true);

        $this->assertXmlStringEqualsXmlString(
            '<Root><IsTrue>1</IsTrue></Root>',
            $xml->asXML()
        );
    }

    public function testAddBoolFalse(): void
    {
        $xml = $this->newDocument();
        $xml->addBool('IsFalse', false);

        $this->assertXmlStringEqualsXmlString(
            '<Root><IsFalse>0</IsFalse></Root>',
            $xml->asXML()
        );
    }

    public function testAddBoolNull(): void
    {
        $xml = $this->newDocument();
        $xml->addBool('IsNull', null);

        $this->assertXmlStringEqualsXmlString('<Root/>', $xml->asXML());
    }

    public function testAddDateTime(): void
    {
        $xml = $this->newDocument();
        $dt = new DateTimeImmutable('2024-06-01 12:34:56');
        $xml->addDateTime('MyDate', $dt);

        $this->assertStringContainsString(
            '<MyDate>01.06.2024 12:34:56</MyDate>',
            $xml->asXML()
        );
    }

    public function testAddDateTimeWithNull(): void
    {
        $xml = $this->newDocument();
        $xml->addDateTime('MyDate', null);

        $this->assertXmlStringEqualsXmlString('<Root/>', $xml->asXML());
    }

    public function testAddAfterbuyGlobal(): void
    {
        $xml = $this->newDocument();

        $mock = $this->createMock(AfterbuyGlobalInterface::class);
        $mock->expects($this->once())->method('simpleXmlElement')->with($xml);

        $xml->addAfterbuyGlobal($mock);
    }

    public function testAddFilter(): void
    {
        $xml = $this->newDocument();

        $filterValueMock = new class() {
            public function getKey()
            {
                return 'FKey';
            }

            public function getValue()
            {
                return 'FVal';
            }
        };

        $filterMock = $this->createMock(FilterInterface::class);
        $filterMock->method('getFilterName')->willReturn('TestFilter');
        $filterMock->method('getFilterValues')->willReturn([$filterValueMock]);

        $xml->addFilter([$filterMock]);

        $xmlString = $xml->asXML();
        $this->assertStringContainsString('<DataFilter>', $xmlString);
        $this->assertStringContainsString('<FilterName>TestFilter</FilterName>', $xmlString);
        $this->assertStringContainsString('<FKey>FVal</FKey>', $xmlString);
    }

    public function testAddProductFilter(): void
    {
        $xml = $this->newDocument();

        $filterMock = $this->createMock(ProductFilterInterface::class);
        $filterMock->method('getName')->willReturn('ArtNr');
        $filterMock->method('getValue')->willReturn('4711');

        $xml->addProductFilter([$filterMock]);

        $xmlString = $xml->asXML();
        $this->assertStringContainsString('<Products>', $xmlString);
        $this->assertStringContainsString('<Product>', $xmlString);
        $this->assertStringContainsString('<ArtNr>4711</ArtNr>', $xmlString);
    }

    public function testAppendContent(): void
    {
        $xml = $this->newDocument();

        $mock = $this->createMock(RequestDtoXmlInterface::class);
        $mock->expects($this->once())->method('appendXmlContent')->with($xml);

        $xml->appendContent($mock);
    }
}
