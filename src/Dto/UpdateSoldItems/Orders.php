<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class Orders implements AfterbuyAppendXmlContentInterface
{
    /**
     * @param Order[] $orders
     */
    public function __construct(
        private readonly array $orders = [],
    ) {
    }

    /**
     * @return Order[]
     */
    #[Assert\Count(min: 1, max: 150)]
    #[Assert\Valid]
    public function getOrders(): array
    {
        return $this->orders;
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $orders = $xml->addChild('Orders');

        foreach ($this->orders as $order) {
            $order->appendXmlContent($orders);
        }
    }
}
