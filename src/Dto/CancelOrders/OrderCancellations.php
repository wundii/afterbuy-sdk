<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CancelOrders;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of order cancellations.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class OrderCancellations implements RequestDtoXmlInterface
{
    /**
     * @param OrderCancellation[] $orderCancellations
     */
    public function __construct(
        private readonly array $orderCancellations = [],
    ) {
    }

    /**
     * @return OrderCancellation[]
     */
    #[Assert\Count(min: 1)]
    #[Assert\Valid]
    public function getOrderCancellations(): array
    {
        return $this->orderCancellations;
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $cancellations = $simpleXml->addChild('OrderCancellations');

        foreach ($this->orderCancellations as $orderCancellation) {
            $orderCancellation->appendXmlContent($cancellations);
        }
    }
}
