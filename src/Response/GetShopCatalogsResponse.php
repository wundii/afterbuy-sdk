<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\Catalogs;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\ErrorMessagesResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<Catalogs>
 */
final class GetShopCatalogsResponse implements AfterbuyResponseInterface
{
    use ErrorMessagesResponseTrait;

    /**
     * @return Catalogs
     */
    public function getResponse(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, Catalogs::class, ['Result']);
    }

    public function getErrorMessages(): array
    {
        return [];
    }
}
