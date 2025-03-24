<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShippingServices;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ShippingServices implements AfterbuyDtoInterface
{
    /**
     * @param ShippingService[] $shippingServices
     */
    public function __construct(
        private array $shippingServices = [],
    ) {
    }

    /**
     * @return ShippingService[]
     */
    public function getShippingServices(): array
    {
        return $this->shippingServices;
    }

    /**
     * @param ShippingService[] $shippingServices
     */
    public function setShippingServices(array $shippingServices): void
    {
        $this->shippingServices = $shippingServices;
    }
}
