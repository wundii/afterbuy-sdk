<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetSoldItems\Orders;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<Orders>
 */
final class GetSoldItemsResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return Orders
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, Orders::class, ['Result'], true);
    }
}
