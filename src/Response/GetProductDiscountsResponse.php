<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetProductDiscounts\ProductDiscounts;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<ProductDiscounts>
 */
final class GetProductDiscountsResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return ProductDiscounts
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, ProductDiscounts::class, ['Result'], true);
    }
}
