<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetStockInfo\Products;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<Products>
 */
final class GetStockInfoResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return Products
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, Products::class, ['Result'], true);
    }
}
