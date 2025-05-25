<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Extends;

use DateTimeInterface;
use DOMDocument;
use SimpleXMLElement;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\FilterInterface;
use Wundii\AfterbuySdk\Interface\ProductFilterInterface;

final class SimpleXMLExtend extends SimpleXMLElement
{
    public function addAfterbuyGlobal(AfterbuyGlobalInterface $afterbuyGlobal): void
    {
        $afterbuyGlobal->simpleXmlElement($this);
    }

    public function addNumber(string $string, null|int|float $value): void
    {
        if ($value === null) {
            return;
        }

        if (is_float($value)) {
            $value = number_format($value, 2, ',', '');
        }

        $this->addChild($string, (string) $value);
    }

    public function addString(string $string, ?string $value): void
    {
        if ($value === null) {
            return;
        }

        if (preg_match('/[<>&]/', $value)) {
            $child = $this->addChild($string);
            $node = dom_import_simplexml($child);
            $domDocument = $node->ownerDocument;
            if (! $domDocument instanceof DOMDocument) {
                return;
            }

            $cdata = $domDocument->createCDATASection($value);
            $node->appendChild($cdata);
        } else {
            $this->addChild($string, $value);
        }
    }

    public function addBool(string $string, ?bool $value): void
    {
        if ($value === null) {
            return;
        }

        $this->addChild($string, $value ? '1' : '0');
    }

    public function addDateTime(string $string, ?DateTimeInterface $dateTime): void
    {
        if (! $dateTime instanceof DateTimeInterface) {
            return;
        }

        $this->addChild($string, $dateTime->format('d.m.Y H:i:s'));
    }

    /**
     * @param FilterInterface[] $filter
     */
    public function addFilter(array $filter): void
    {
        $dataFilter = $this->addChild('DataFilter');

        foreach ($filter as $filterItem) {
            $dataFilterItem = $dataFilter->addChild('Filter');
            $dataFilterItem->addChild('FilterName', $filterItem->getFilterName());

            $dataFilterValues = $dataFilterItem->addChild('FilterValues');
            foreach ($filterItem->getFilterValues() as $filterValue) {
                $dataFilterValues->addChild($filterValue->getKey(), $filterValue->getValue());
            }
        }
    }

    /**
     * @param ProductFilterInterface[] $filter
     */
    public function addProductFilter(array $filter): void
    {
        $dataFilter = $this->addChild('Products');

        foreach ($filter as $filterItem) {
            $dataFilterItem = $dataFilter->addChild('Product');
            $dataFilterItem->addChild($filterItem->getName(), $filterItem->getValue());
        }
    }

    public function appendContent(AfterbuyAppendXmlContentInterface $afterbuyAppendXmlContent): void
    {
        $afterbuyAppendXmlContent->appendXmlContent($this);
    }
}
