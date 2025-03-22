<?php

declare(strict_types=1);

namespace AfterbuySdk\Extends;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Interface\FilterInterface;
use DOMCdataSection;
use DOMDocument;
use SimpleXMLElement;

final class SimpleXMLExtend extends SimpleXMLElement
{
    public function addAfterbuyGlobal(AfterbuyGlobal $afterbuyGlobal): void
    {
        $afterbuyGlobal->simpleXmlElement($this);
    }

    public function addCdata(string $cdata): void
    {
        $domElement = dom_import_simplexml($this);

        $domOwnerDocument = $domElement->ownerDocument;
        if (! $domOwnerDocument instanceof DOMDocument) {
            return;
        }

        $domCdataSection = $domOwnerDocument->createCDATASection($cdata);
        if (! $domCdataSection instanceof DOMCdataSection) {
            return;
        }

        $domElement->appendChild($domCdataSection);
    }

    public function addLimit(string $string, ?int $value): void
    {
        if ($value === null) {
            return;
        }

        $this->addChild($string, (string) $value);
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
}
