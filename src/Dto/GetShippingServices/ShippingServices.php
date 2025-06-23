<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShippingServices;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of shipping services.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class ShippingServices implements ResponseDtoInterface
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
