<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateSoldItems;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of payment services.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class Orders implements RequestDtoXmlInterface
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

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $orders = $simpleXml->addChild('Orders');

        foreach ($this->orders as $order) {
            $order->appendXmlContent($orders);
        }
    }
}
