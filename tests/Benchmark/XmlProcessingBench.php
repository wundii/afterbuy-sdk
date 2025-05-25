<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Benchmark;

use PhpBench\Attributes\BeforeMethods;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\Revs;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;

#[BeforeMethods('setUp')]
class XmlProcessingBench
{
    private const SAMPLE_PRODUCTS = [
        [
            'id' => 1,
            'name' => 'Product 1',
            'price' => 19.99,
        ],
        [
            'id' => 2,
            'name' => 'Product 2',
            'price' => 29.99,
        ],
        [
            'id' => 3,
            'name' => 'Product 3',
            'price' => 54.99,
        ],
    ];

    private SimpleXMLExtend $xml;

    private array $testData;

    public function setUp(): void
    {
        $this->xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $this->testData = self::SAMPLE_PRODUCTS;
    }

    /**
     * Testet die Performance der XML-Generierung mit verschiedenen Datenmengen
     */
    #[Revs(1000)]
    #[Iterations(5)]
    public function benchXmlGeneration(): void
    {
        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        foreach ($this->testData as $product) {
            $productNode = $xml->addChild('Product');
            $productNode->addChild('ProductID', (string) $product['id']);
            $productNode->addChild('ProductName', $product['name']);
            $productNode->addChild('ProductPrice', (string) $product['price']);
        }
        $xml->asXML();
    }

    /**
     * Vergleicht verschiedene Methoden der Filterverarbeitung
     */
    #[Revs(1000)]
    #[Iterations(5)]
    public function benchFilterProcessing(): void
    {
        $filters = [
            [
                'field' => 'price',
                'value' => 20.00,
                'operator' => '>',
            ],
            [
                'field' => 'name',
                'value' => 'Product',
                'operator' => 'contains',
            ],
        ];

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $filterNode = $xml->addChild('Filters');

        foreach ($filters as $filter) {
            $filterItemNode = $filterNode->addChild('Filter');
            $filterItemNode->addChild('FilterField', $filter['field']);
            $filterItemNode->addChild('FilterValue', (string) $filter['value']);
            $filterItemNode->addChild('FilterOperator', $filter['operator']);
        }
    }

    /**
     * Testet die Performance der DetailLevel-Verarbeitung
     */
    #[Revs(1000)]
    #[Iterations(5)]
    public function benchDetailLevelProcessing(): void
    {
        $detailLevels = [
            DetailLevelEnum::FIRST,
            DetailLevelEnum::SECOND,
            DetailLevelEnum::THIRD,
        ];

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $detailNode = $xml->addChild('DetailLevel');

        foreach ($detailLevels as $level) {
            $detailNode->addChild('Level', (string) $level->value);
        }
    }

    /**
     * Testet die Performance verschiedener Array-zu-XML Transformationen
     */
    #[Revs(1000)]
    #[Iterations(5)]
    public function benchArrayToXmlTransformation(): void
    {
        $complexData = [
            'products' => self::SAMPLE_PRODUCTS,
            'filters' => [
                'price' => [
                    'min' => 10,
                    'max' => 100,
                ],
                'categories' => ['1', '2', '3'],
            ],
        ];

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $this->arrayToXml($complexData, $xml);
    }

    private function arrayToXml(array $data, SimpleXMLExtend $xml): void
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $child = $xml->addChild(is_numeric($key) ? 'item' : $key);
                $this->arrayToXml($value, $child);
            } else {
                $xml->addChild(is_numeric($key) ? 'item' : $key, (string) $value);
            }
        }
    }
}
