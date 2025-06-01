<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Extension;

use DateTimeInterface;
use DOMDocument;
use SimpleXMLElement;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\FilterInterface;
use Wundii\AfterbuySdk\Interface\ProductFilterInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final class SimpleXMLExtend extends SimpleXMLElement
{
    public function addAfterbuyGlobal(AfterbuyGlobalInterface $afterbuyGlobal): void
    {
        $afterbuyGlobal->simpleXmlElement($this);
    }

    public function addNumber(string $key, null|int|float $value): void
    {
        if ($value === null) {
            return;
        }

        if (is_float($value)) {
            $value = number_format($value, 2, ',', '');
        }

        $this->addChild($key, (string) $value);
    }

    public function addString(string $key, ?string $value): void
    {
        if ($value === null) {
            return;
        }

        if (preg_match('/[<>&]/', $value)) {
            $child = $this->addChild($key);
            $node = dom_import_simplexml($child);
            $domDocument = $node->ownerDocument;
            if (! $domDocument instanceof DOMDocument) {
                return;
            }

            $cdata = $domDocument->createCDATASection($value);
            $node->appendChild($cdata);
        } else {
            $this->addChild($key, $value);
        }
    }

    public function addBool(string $key, ?bool $value): void
    {
        if ($value === null) {
            return;
        }

        $this->addChild($key, $value ? '1' : '0');
    }

    public function addDateTime(string $key, ?DateTimeInterface $dateTime): void
    {
        if (! $dateTime instanceof DateTimeInterface) {
            return;
        }

        $this->addChild($key, $dateTime->format('d.m.Y H:i:s'));
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

    public function appendContent(RequestDtoXmlInterface $afterbuyRequestDtoXml): void
    {
        $afterbuyRequestDtoXml->appendXmlContent($this);
    }
}
