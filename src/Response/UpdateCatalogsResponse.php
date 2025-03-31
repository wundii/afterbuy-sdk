<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\UpdateCatalogs\CatalogNotDeleteds;
use AfterbuySdk\Dto\UpdateCatalogs\NewCatalogs;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<NewCatalogs|CatalogNotDeleteds>
 */
final class UpdateCatalogsResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return NewCatalogs|CatalogNotDeleteds
     */
    public function getResponse(): AfterbuyDtoInterface
    {
        if (str_contains($this->content, 'CatalogNotDeleted')) {
            return $this->dataMapper->xml($this->content, CatalogNotDeleteds::class, ['Result']);
        }

        return $this->dataMapper->xml($this->content, NewCatalogs::class, ['Result']);
    }
}
