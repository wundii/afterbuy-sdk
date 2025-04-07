<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateSoldItems;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

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
