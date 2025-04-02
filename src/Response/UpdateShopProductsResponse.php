<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\UpdateShopProducts\NewProducts;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<NewProducts>
 */
final class UpdateShopProductsResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return NewProducts
     */
    public function getResult(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, NewProducts::class, ['Result']);
    }
}
