<?php

declare(strict_types=1);

namespace AfterbuySdk\Extends;

use AfterbuySdk\Dto\AfterbuyGlobal;
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
}
