<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class BuyerInfo implements AfterbuyDtoInterface
{
    public function __construct(
        private BillingAddress $billingAddress,
        private ShippingAddress $shippingAddress,
    ) {
    }

    public function getBillingAddress(): BillingAddress
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(BillingAddress $billingAddress): void
    {
        $this->billingAddress = $billingAddress;
    }

    public function getShippingAddress(): ShippingAddress
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(ShippingAddress $shippingAddress): void
    {
        $this->shippingAddress = $shippingAddress;
    }
}
