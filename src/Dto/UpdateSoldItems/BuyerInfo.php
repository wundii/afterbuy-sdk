<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Symfony\Component\Validator\Constraints as Assert;

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

    #[Assert\Valid]
    public function getShippingAddress(): ShippingAddress
    {
        return $this->shippingAddress;
    }
}
