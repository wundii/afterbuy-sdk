<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateSoldItems;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class BuyerInfo implements RequestDtoXmlInterface
{
    public function __construct(
        private ShippingAddress $shippingAddress,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $buyerInfo = $simpleXml->addChild('BuyerInfo');
        $this->shippingAddress->appendXmlContent($buyerInfo);
    }

    #[Assert\Valid]
    public function getShippingAddress(): ShippingAddress
    {
        return $this->shippingAddress;
    }
}
