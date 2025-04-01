<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final readonly class BuyerInfo implements AfterbuyDtoInterface
{
    public function __construct(
        private ShippingAddress $shippingAddress,
    ) {
    }

    public function getShippingAddress(): ShippingAddress
    {
        return $this->shippingAddress;
    }
}
