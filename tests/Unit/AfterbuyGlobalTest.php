<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use SimpleXMLElement;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
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
            errorLanguageEnum: ErrorLanguageEnum::GERMAN
        );

        $this->xml = new SimpleXMLElement(AfterbuyGlobal::DefaultXmlRoot);
    }

    public function testGetDetailLevelReturnsFirstLevelWhenNoEnumsSet(): void
    {
        $this->assertSame('0', $this->afterbuyGlobal->getDetailLevel());
    }

    public function testSetDetailLevelEnumsFiltersEnumsAboveMaxLevel(): void
    {
        $enums = [
            DetailLevelEnum::FIRST,
            DetailLevelEnum::SECOND,
            DetailLevelEnum::THIRD,
        ];

        $this->afterbuyGlobal->setDetailLevelEnums($enums, DetailLevelEnum::SECOND);

        $this->assertSame('2', $this->afterbuyGlobal->getDetailLevel());
    }

    public function testSetDetailLevelEnumsHandlesEmptyArray(): void
    {
        $this->afterbuyGlobal->setDetailLevelEnums([], DetailLevelEnum::THIRD);

        $this->assertSame('0', $this->afterbuyGlobal->getDetailLevel());
    }

    public function testSetDetailLevelEnumsRemovesDuplicates(): void
    {
        $enums = [
            DetailLevelEnum::FIRST,
            DetailLevelEnum::FIRST,
            DetailLevelEnum::SECOND,
        ];

        $this->afterbuyGlobal->setDetailLevelEnums($enums, DetailLevelEnum::SECOND);

        $this->assertSame('2', $this->afterbuyGlobal->getDetailLevel());
    }

    public function testSetDetailLevelEnumsWithMaxLevelFirst(): void
    {
        $enums = [
            DetailLevelEnum::THIRD,
            DetailLevelEnum::FOURTH,
            DetailLevelEnum::FIFTH,
        ];

        $this->afterbuyGlobal->setDetailLevelEnums($enums, DetailLevelEnum::FIRST);

        $this->assertSame('0', $this->afterbuyGlobal->getDetailLevel());
    }

    public function testSetDetailLevelEnumsWithSixthLevel(): void
    {
        $enums = [
            DetailLevelEnum::FIRST,
            DetailLevelEnum::SECOND,
            DetailLevelEnum::SIXTH,
        ];

        $this->afterbuyGlobal->setDetailLevelEnums($enums, DetailLevelEnum::THIRD);

        $this->assertSame('2', $this->afterbuyGlobal->getDetailLevel());
    }

    #[DataProvider('detailLevelCombinationsProvider')]
    public function testVariousDetailLevelCombinations(array $enums, DetailLevelEnum $maxLevel, string $expectedSum): void
    {
        $this->afterbuyGlobal->setDetailLevelEnums($enums, $maxLevel);
        $this->assertSame($expectedSum, $this->afterbuyGlobal->getDetailLevel());
    }

    public static function detailLevelCombinationsProvider(): array
    {
        return [
            'FIRST' => [
                [DetailLevelEnum::FIRST],
                DetailLevelEnum::FIRST,
                '0',
            ],
            'FIRST and SECOND' => [
                [DetailLevelEnum::FIRST, DetailLevelEnum::SECOND],
                DetailLevelEnum::SECOND,
                '2',
            ],
            'FIRST, SECOND and THIRD' => [
                [DetailLevelEnum::FIRST, DetailLevelEnum::SECOND, DetailLevelEnum::THIRD],
                DetailLevelEnum::THIRD,
                '6',
            ],
            'FOURTH' => [
                [DetailLevelEnum::FOURTH],
                DetailLevelEnum::EIGHTH,
                '8',
            ],
            'FIRST and SIXTH, max SECOND' => [
                [DetailLevelEnum::FIRST, DetailLevelEnum::SIXTH],
                DetailLevelEnum::SECOND,
                '0',
            ],
        ];
    }

    public function testThrowsExceptionWhenCallNameNotSet(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Call name must be set before generating XML');

        $this->afterbuyGlobal->simpleXmlElement($this->xml);
    }

    public function testGeneratesCorrectXmlStructure(): void
    {
        $this->afterbuyGlobal->setCallName('TestCall');
        $this->afterbuyGlobal->setDetailLevelEnums(
            [
                DetailLevelEnum::FIRST,
                DetailLevelEnum::SECOND,
                DetailLevelEnum::THIRD,
            ],
            DetailLevelEnum::SIXTH,
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
        $this->afterbuyGlobal->setCallName('TestCall');
        $this->afterbuyGlobal->setDetailLevelEnums(
            [DetailLevelEnum::FIRST, DetailLevelEnum::SECOND],
            DetailLevelEnum::SECOND
        );

        $this->afterbuyGlobal->simpleXmlElement($this->xml);

        $afterbuyGlobal = $this->xml->AfterbuyGlobal;
        $this->assertSame('2', (string) $afterbuyGlobal->DetailLevel);
    }

    public function testXmlStructureCompleteness(): void
    {
        $this->afterbuyGlobal->setCallName('TestCall');
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
        $this->afterbuyGlobal->setCallName('TestCall');
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
        $this->afterbuyGlobal->setCallName($callName);
        $this->afterbuyGlobal->simpleXmlElement($this->xml);

        $this->assertEquals($callName, (string) $this->xml->AfterbuyGlobal->CallName);
    }

    public static function callNameProvider(): array
    {
        return [
            'standard call name' => ['GetSoldItems'],
            'with numbers' => ['Test123'],
            'with special chars' => ['Test-Call'],
            'empty string' => [''],
        ];
    }
}
