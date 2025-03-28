<?php

declare(strict_types=1);

namespace AfterbuySdk\Extends;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\CountryIsoEnum;
use AfterbuySdk\Filter\GetShippingCost\ShippingInfo;
use AfterbuySdk\Interface\FilterInterface;
use AfterbuySdk\Interface\ProductFilterInterface;
use DateTimeInterface;
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

    public function addNumber(string $string, ?int $value): void
    {
        if ($value === null) {
            return;
        }

        $this->addChild($string, (string) $value);
    }

    public function addString(string $string, ?string $value): void
    {
        if ($value === null) {
            return;
        }

        $this->addChild($string, $value);
    }

    public function addBool(string $string, ?bool $value): void
    {
        if ($value === null) {
            return;
        }

        $this->addChild($string, $value ? '1' : '0');
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

    public function addShippingInfo(ShippingInfo $shippingInfo): void
    {
        $shippingInfoElement = $this->addChild('ShippingInfo');

        $productIds = $shippingInfo->getProductIds();

        if (count($productIds) > 1) {
            $productIdsElement = $shippingInfoElement->addChild('Products');
            foreach ($productIds as $productId) {
                $productIdsElement->addChild('ProductID', (string) $productId);
            }
        } else {
            $shippingInfoElement->addChild('ProductID', (string) $productIds[0]);
        }

        $shippingInfoElement->addChild('ItemsCount', (string) $shippingInfo->getItemsCount());
        $shippingInfoElement->addChild('ItemsWeight', (string) $shippingInfo->getItemsWeight());
        $shippingInfoElement->addChild('ItemsPrice', (string) $shippingInfo->getItemsPrice());

        if ($shippingInfo->getShippingCountry() instanceof CountryIsoEnum) {
            $shippingInfoElement->addChild('ShippingCountry', $shippingInfo->getShippingCountry()->value);
        }

        if ($shippingInfo->getShippingGroup() !== null) {
            $shippingInfoElement->addChild('ShippingGroup', $shippingInfo->getShippingGroup());
        }

        if ($shippingInfo->getPostalCode() !== null) {
            $shippingInfoElement->addChild('PostalCode', $shippingInfo->getPostalCode());
        }
    }

    public function addDateTime(string $string, ?DateTimeInterface $dateTime): void
    {
        if (! $dateTime instanceof DateTimeInterface) {
            return;
        }

        $this->addChild($string, $dateTime->format('d.m.Y H:i:s'));
    }
}
