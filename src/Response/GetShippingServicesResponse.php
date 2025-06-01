<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetShippingServices\ShippingServices;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<ShippingServices>
 */
final class GetShippingServicesResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return ShippingServices
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, ShippingServices::class, ['Result'], true);
    }
}
