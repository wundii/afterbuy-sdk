<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\GetShippingCost\ShippingService;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;
use Exception;

/**
 * @template-implements AfterbuyResponseInterface<ShippingService>
 */
final class GetShippingCostResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return ?ShippingService
     */
    public function getResult(): ?AfterbuyDtoInterface
    {
        try {
            return $this->dataMapper->xml($this->content, ShippingService::class, ['Result', 'ShippingService']);
        } catch (Exception) {
            return null;
        }
    }
}
