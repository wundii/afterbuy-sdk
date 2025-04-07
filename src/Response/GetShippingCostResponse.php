<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Exception;
use Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingService;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyResponseInterface;
use Wundii\AfterbuySdk\Trait\AfterbuyResponseTrait;

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
