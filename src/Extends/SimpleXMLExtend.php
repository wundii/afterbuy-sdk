<?php

declare(strict_types=1);

namespace AfterbuySdk\Extends;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\UpdateCatalogs\Catalog;
use AfterbuySdk\Dto\UpdateCatalogs\Catalogs;
use AfterbuySdk\Dto\UpdateSoldItems\Orders;
use AfterbuySdk\Enum\CountryIsoEnum;
use AfterbuySdk\Filter\GetShippingCost\ShippingInfo;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
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

    /**
     * Alle nachfolgenden Methoden müssen noch Refactored werden mit AfterbuyAppendXmlContentInterface
     */
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

    public function addUpdateCatalogs(Catalogs $catalogs): void
    {
        $addCatalogs = function (array $catalogs, SimpleXMLElement $catalogsElement) use (&$addCatalogs): void {
            foreach ($catalogs as $catalog) {
                /** @var self $catalogElement */
                /** @var Catalog $catalog */
                $catalogElement = $catalogsElement->addChild('Catalog');
                $catalogElement->addNumber('CatalogID', $catalog->getCatalogId());
                $catalogElement->addString('CatalogName', $catalog->getCatalogName());
                $catalogElement->addString('CatalogDescription', $catalog->getCatalogDescription());
                $catalogElement->addString('AdditionalURL', $catalog->getAdditionalUrl());
                $catalogElement->addNumber('Level', $catalog->getLevel());
                $catalogElement->addNumber('Position', $catalog->getPosition());
                $catalogElement->addString('AdditionalText', $catalog->getAdditionalText());
                $catalogElement->addBool('ShowCatalog', $catalog->getShowCatalog());
                $catalogElement->addString('Picture', $catalog->getPicture());
                $catalogElement->addString('MouseOverPicture', $catalog->getMouseOverPicture());

                if ($catalog->getCatalog() !== []) {
                    $addCatalogs($catalog->getCatalog(), $catalogElement);
                }
            }
        };

        $catalogsElement = $this->addChild('Catalogs');
        $catalogsElement->addChild('UpdateAction', (string) $catalogs->getUpdateActionEnum()->value);

        $addCatalogs($catalogs->getCatalogs(), $catalogsElement);
    }
}
