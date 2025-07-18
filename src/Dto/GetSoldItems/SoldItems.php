<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of sold items.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class SoldItems implements ResponseDtoInterface
{
    /**
     * @param SoldItem[] $soldItem
     */
    public function __construct(
        private array $soldItem = [],
        private ?int $itemsInOrder = null,
    ) {
    }

    public function getItemsInOrder(): ?int
    {
        return $this->itemsInOrder;
    }

    public function setItemsInOrder(?int $itemsInOrder): void
    {
        $this->itemsInOrder = $itemsInOrder;
    }

    /**
     * @return SoldItem[]
     */
    public function getSoldItem(): array
    {
        return $this->soldItem;
    }

    public function setSoldItem(?SoldItem $soldItem): void
    {
        if (! $soldItem instanceof SoldItem) {
            return;
        }

        $this->soldItem[] = $soldItem;
    }
}
