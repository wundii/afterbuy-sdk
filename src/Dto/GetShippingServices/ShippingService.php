<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShippingServices;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ShippingService implements ResponseDtoInterface
{
    /**
     * @param ShippingMethod[] $shippingMethods
     */
    public function __construct(
        private string $name,
        private ?string $displayArea = null,
        private int $groupPrio = 0,
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

    public function getDisplayArea(): ?string
    {
        return $this->displayArea;
    }

    public function setDisplayArea(?string $displayArea): void
    {
        $this->displayArea = $displayArea;
    }

    public function getGroupPrio(): int
    {
        return $this->groupPrio;
    }

    public function setGroupPrio(int $groupPrio): void
    {
        $this->groupPrio = $groupPrio;
    }
}
