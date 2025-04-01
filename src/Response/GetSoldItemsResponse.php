<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\GetSoldItems\Orders;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<Orders>
 */
final class GetSoldItemsResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return Orders
     */
    public function getResult(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, Orders::class, ['Result'], true);
    }
}
