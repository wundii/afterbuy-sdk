<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShippingServices;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ShippingService implements AfterbuyDtoInterface
{
    /**
     * @param ShippingMethod[] $shippingMethods
     */
    public function __construct(
        private string $name,
        private array $shippingMethods = [],
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ShippingMethod[]
     */
    public function getShippingMethods(): array
    {
        return $this->shippingMethods;
    }

    /**
     * @param ShippingMethod[] $shippingMethods
     */
    public function setShippingMethods(array $shippingMethods): void
    {
        $this->shippingMethods = $shippingMethods;
    }
}
