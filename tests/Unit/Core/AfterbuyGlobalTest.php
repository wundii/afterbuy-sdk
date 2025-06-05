<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Core;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyDetailLevelEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\AfterbuySdk\Enum\ErrorLanguageEnum;

class AfterbuyGlobalTest extends TestCase
{
    private AfterbuyGlobal $afterbuyGlobal;

    private SimpleXMLElement $xml;

    protected function setUp(): void
    {
        $this->afterbuyGlobal = new AfterbuyGlobal(
            accountToken: 'test_token',
            partnerToken: 'partner_token',
            afterbuyEndpointEnum: AfterbuyEndpointEnum::SANDBOX,
            errorLanguageEnum: ErrorLanguageEnum::GERMAN
        );

        $this->xml = new SimpleXMLElement(AfterbuyGlobal::DefaultXmlRoot);
    }

    public function testGetEndpointEnum(): void
    {
        $this->assertSame(AfterbuyEndpointEnum::SANDBOX, $this->afterbuyGlobal->getEndpointEnum());
    }

    public function testGetDetailLevelReturnsFirstLevelWhenNoEnumsSet(): void
    {
        $this->assertSame('0', $this->afterbuyGlobal->getDetailLevel());
    }

    public function testSetDetailLevelEnumWithOneEnum(): void
    {
        $this->afterbuyGlobal->setDetailLevelEnum(AfterbuyDetailLevelEnum::FIRST, AfterbuyDetailLevelEnum::SECOND);

        $this->assertSame('0', $this->afterbuyGlobal->getDetailLevel());
    }

    public function testSetDetailLevelEnumsFiltersEnumsAboveMaxLevel(): void
    {
        $enums = [
            AfterbuyDetailLevelEnum::FIRST,
            AfterbuyDetailLevelEnum::SECOND,
            AfterbuyDetailLevelEnum::THIRD,
        ];

        $this->afterbuyGlobal->setDetailLevelEnum($enums, AfterbuyDetailLevelEnum::SECOND);

        $this->assertSame('2', $this->afterbuyGlobal->getDetailLevel());
    }

    public function testSetDetailLevelEnumsHandlesEmptyArray(): void
    {
        $this->afterbuyGlobal->setDetailLevelEnum([], AfterbuyDetailLevelEnum::THIRD);

        $this->assertSame('0', $this->afterbuyGlobal->getDetailLevel());
    }

    public function testSetDetailLevelEnumsRemovesDuplicates(): void
    {
        $enums = [
            AfterbuyDetailLevelEnum::FIRST,
            AfterbuyDetailLevelEnum::FIRST,
            AfterbuyDetailLevelEnum::SECOND,
        ];

        $this->afterbuyGlobal->setDetailLevelEnum($enums, AfterbuyDetailLevelEnum::SECOND);

        $this->assertSame('2', $this->afterbuyGlobal->getDetailLevel());
    }

    public function testSetDetailLevelEnumsWithMaxLevelFirst(): void
    {
        $enums = [
            AfterbuyDetailLevelEnum::THIRD,
            AfterbuyDetailLevelEnum::FOURTH,
            AfterbuyDetailLevelEnum::FIFTH,
        ];

        $this->afterbuyGlobal->setDetailLevelEnum($enums, AfterbuyDetailLevelEnum::FIRST);

        $this->assertSame('0', $this->afterbuyGlobal->getDetailLevel());
    }

    public function testSetDetailLevelEnumsWithSixthLevel(): void
    {
        $enums = [
            AfterbuyDetailLevelEnum::FIRST,
            AfterbuyDetailLevelEnum::SECOND,
            AfterbuyDetailLevelEnum::SIXTH,
        ];

        $this->afterbuyGlobal->setDetailLevelEnum($enums, AfterbuyDetailLevelEnum::THIRD);

        $this->assertSame('2', $this->afterbuyGlobal->getDetailLevel());
    }

    #[DataProvider('detailLevelCombinationsProvider')]
    public function testVariousDetailLevelCombinations(array $enums, AfterbuyDetailLevelEnum $maxLevel, string $expectedSum): void
    {
        $this->afterbuyGlobal->setDetailLevelEnum($enums, $maxLevel);
        $this->assertSame($expectedSum, $this->afterbuyGlobal->getDetailLevel());
    }

    public static function detailLevelCombinationsProvider(): array
    {
        return [
            'FIRST' => [
                [AfterbuyDetailLevelEnum::FIRST],
                AfterbuyDetailLevelEnum::FIRST,
                '0',
            ],
            'FIRST and SECOND' => [
                [AfterbuyDetailLevelEnum::FIRST, AfterbuyDetailLevelEnum::SECOND],
                AfterbuyDetailLevelEnum::SECOND,
                '2',
            ],
            'FIRST, SECOND and THIRD' => [
                [AfterbuyDetailLevelEnum::FIRST, AfterbuyDetailLevelEnum::SECOND, AfterbuyDetailLevelEnum::THIRD],
                AfterbuyDetailLevelEnum::THIRD,
                '6',
            ],
            'FOURTH' => [
                [AfterbuyDetailLevelEnum::FOURTH],
                AfterbuyDetailLevelEnum::EIGHTH,
                '8',
            ],
            'FIRST and SIXTH, max SECOND' => [
                [AfterbuyDetailLevelEnum::FIRST, AfterbuyDetailLevelEnum::SIXTH],
                AfterbuyDetailLevelEnum::SECOND,
                '0',
            ],
        ];
    }

    public function testGenerateSandboxElementWithShop(): void
    {
        $this->afterbuyGlobal->setPayloadEnvironments(AfterbuyApiSourceEnum::SHOP, 'TestCall');
        $this->afterbuyGlobal->simpleXmlElement($this->xml);

        $xmlString = $this->xml->asXML();
        $this->assertNotFalse($xmlString);

        $afterbuyGlobalXml = $this->xml->AfterbuyGlobal;

        $this->assertNotFalse($afterbuyGlobalXml);
        $this->assertSame('shop', (string) $afterbuyGlobalXml->Sandbox);
    }

    public function testGenerateSandboxElementWithXML(): void
    {
        $this->afterbuyGlobal->setPayloadEnvironments(AfterbuyApiSourceEnum::XML, 'TestCall');
        $this->afterbuyGlobal->simpleXmlElement($this->xml);

        $xmlString = $this->xml->asXML();
        $this->assertNotFalse($xmlString);

        $afterbuyGlobal = $this->xml->AfterbuyGlobal;

        $this->assertNotFalse($afterbuyGlobal);
        $this->assertSame('XML', (string) $afterbuyGlobal->Sandbox);
    }

    public function testGenerateProductionXml(): void
    {
        $afterbuyGlobal = new AfterbuyGlobal(
            accountToken: 'test_token',
            partnerToken: 'partner_token',
            afterbuyEndpointEnum: AfterbuyEndpointEnum::PROD,
            errorLanguageEnum: ErrorLanguageEnum::GERMAN
        );

        $afterbuyGlobal->setPayloadEnvironments(AfterbuyApiSourceEnum::XML, 'TestCall');
        $afterbuyGlobal->simpleXmlElement($this->xml);

        $xmlString = $this->xml->asXML();
        $this->assertNotFalse($xmlString);

        $afterbuyGlobal = $this->xml->AfterbuyGlobal;

        $this->assertNotFalse($afterbuyGlobal);
        $this->assertFalse(property_exists($afterbuyGlobal, 'Sandbox'));
    }

    public function testGeneratesCorrectXmlStructure(): void
    {
        $this->afterbuyGlobal->setPayloadEnvironments(AfterbuyApiSourceEnum::XML, 'TestCall');
        $this->afterbuyGlobal->setDetailLevelEnum(
            [
                AfterbuyDetailLevelEnum::FIRST,
                AfterbuyDetailLevelEnum::SECOND,
                AfterbuyDetailLevelEnum::THIRD,
            ],
            AfterbuyDetailLevelEnum::SIXTH,
        );
        $this->afterbuyGlobal->simpleXmlElement($this->xml);

        $xmlString = $this->xml->asXML();
        $this->assertNotFalse($xmlString);

        $afterbuyGlobal = $this->xml->AfterbuyGlobal;

        $this->assertNotFalse($afterbuyGlobal);
        $this->assertSame('test_token', (string) $afterbuyGlobal->AccountToken);
        $this->assertSame('partner_token', (string) $afterbuyGlobal->PartnerToken);
        $this->assertSame(ErrorLanguageEnum::GERMAN->value, (string) $afterbuyGlobal->ErrorLanguage);
        $this->assertSame('TestCall', (string) $afterbuyGlobal->CallName);
        $this->assertSame('6', (string) $afterbuyGlobal->DetailLevel);
    }

    public function testGeneratesCorrectXmlWithCustomDetailLevel(): void
    {
        $this->afterbuyGlobal->setPayloadEnvironments(AfterbuyApiSourceEnum::XML, 'TestCall');
        $this->afterbuyGlobal->setDetailLevelEnum(
            [AfterbuyDetailLevelEnum::FIRST, AfterbuyDetailLevelEnum::SECOND],
            AfterbuyDetailLevelEnum::SECOND
        );

        $this->afterbuyGlobal->simpleXmlElement($this->xml);

        $afterbuyGlobal = $this->xml->AfterbuyGlobal;
        $this->assertSame('2', (string) $afterbuyGlobal->DetailLevel);
    }

    public function testXmlStructureCompleteness(): void
    {
        $this->afterbuyGlobal->setPayloadEnvironments(AfterbuyApiSourceEnum::XML, 'TestCall');
        $this->afterbuyGlobal->simpleXmlElement($this->xml);

        $afterbuyGlobal = $this->xml->AfterbuyGlobal;

        $requiredElements = [
            'AccountToken',
            'PartnerToken',
            'ErrorLanguage',
            'CallName',
            'DetailLevel',
        ];

        foreach ($requiredElements as $element) {
            $this->assertTrue(
                isset($afterbuyGlobal->{$element}),
                "XML sollte ein {$element} Element enthalten"
            );
        }
    }

    public function testXmlEncodingAndFormat(): void
    {
        $this->afterbuyGlobal->setPayloadEnvironments(AfterbuyApiSourceEnum::XML, 'TestCall');
        $this->afterbuyGlobal->simpleXmlElement($this->xml);

        $xmlString = $this->xml->asXML();
        $this->assertNotFalse($xmlString);
        $this->assertStringContainsString('<?xml version="1.0" encoding="utf-8"?>', $xmlString);
        $this->assertStringContainsString('<Request>', $xmlString);

        $loadedXml = simplexml_load_string($xmlString);
        $this->assertNotFalse($loadedXml);
    }

    #[DataProvider('callNameProvider')]
    public function testVariousCallNames(string $callName): void
    {
        $this->afterbuyGlobal->setPayloadEnvironments(AfterbuyApiSourceEnum::XML, $callName);
        $this->afterbuyGlobal->simpleXmlElement($this->xml);

        $this->assertEquals($callName, (string) $this->xml->AfterbuyGlobal->CallName);
    }

    public static function callNameProvider(): array
    {
        return [
            'standard call name' => ['GetSoldItems'],
            'with numbers' => ['Test123'],
            'with special chars' => ['Test-Call'],
            'empty string' => ['noCallNameSet'],
        ];
    }
}
