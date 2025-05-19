<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetShopProducts\Products;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyResponseInterface;
use Wundii\AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<Products>
 */
final class GetShopProductsResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return Products
     */
    public function getResult(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, Products::class, ['Result'], true);
    }
}
