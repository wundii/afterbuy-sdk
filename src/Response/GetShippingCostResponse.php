<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Exception;
use Wundii\AfterbuySdk\Dto\GetShippingCost\ShippingService;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<ShippingService>
 */
final class GetShippingCostResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return ?ShippingService
     */
    public function getResult(): ?ResponseDtoInterface
    {
        try {
            return $this->dataMapper->xml($this->content, ShippingService::class, ['Result', 'ShippingService']);
        } catch (Exception) {
            return null;
        }
    }
}
