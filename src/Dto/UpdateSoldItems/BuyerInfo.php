<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class BuyerInfo implements AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private ShippingAddress $shippingAddress,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $buyerInfo = $xml->addChild('BuyerInfo');
        $this->shippingAddress->appendXmlContent($buyerInfo);
    }

    public function getShippingAddress(): ShippingAddress
    {
        return $this->shippingAddress;
    }
}
