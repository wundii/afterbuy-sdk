<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShippingCost;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of payment services.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class ShippingService implements ResponseDtoInterface
{
    /**
     * @param ShippingMethods[] $shippingMethods
     */
    public function __construct(
        private string $shippingServiceName,
        private string $shippingServicePriority,
        private array $shippingMethods = [],
    ) {
    }

    /**
     * @return ShippingMethods[]
     */
    public function getShippingMethods(): array
    {
        return $this->shippingMethods;
    }

    /**
     * @param ShippingMethods[] $shippingMethods
     */
    public function setShippingMethods(null|array|ShippingMethods $shippingMethods): void
    {
        if ($shippingMethods === null) {
            return;
        }

        if (is_array($shippingMethods)) {
            $this->shippingMethods = array_merge($this->shippingMethods, $shippingMethods);
            return;
        }

        $this->shippingMethods[] = $shippingMethods;
    }

    public function getShippingServiceName(): string
    {
        return $this->shippingServiceName;
    }

    public function setShippingServiceName(string $shippingServiceName): void
    {
        $this->shippingServiceName = $shippingServiceName;
    }

    public function getShippingServicePriority(): string
    {
        return $this->shippingServicePriority;
    }

    public function setShippingServicePriority(string $shippingServicePriority): void
    {
        $this->shippingServicePriority = $shippingServicePriority;
    }
}
