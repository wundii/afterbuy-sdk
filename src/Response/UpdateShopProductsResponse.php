<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\UpdateShopProducts\NewProducts;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<NewProducts>
 */
final class UpdateShopProductsResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return NewProducts
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, NewProducts::class, ['Result'], true);
    }
}
