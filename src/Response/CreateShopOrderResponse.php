<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\CreateShopOrder\ShopResponse;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<ShopResponse>
 */
final class CreateShopOrderResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return ShopResponse
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, ShopResponse::class, ['data'], true);
    }
}
