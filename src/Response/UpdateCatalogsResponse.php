<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\UpdateCatalogs\CatalogNotDeleteds;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\NewCatalogs;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyResponseInterface;
use Wundii\AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<NewCatalogs|CatalogNotDeleteds>
 */
final class UpdateCatalogsResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return NewCatalogs|CatalogNotDeleteds
     */
    public function getResult(): AfterbuyDtoInterface
    {
        if (str_contains($this->content, 'CatalogNotDeleted')) {
            return $this->dataMapper->xml($this->content, CatalogNotDeleteds::class, ['Result']);
        }

        return $this->dataMapper->xml($this->content, NewCatalogs::class, ['Result'], true);
    }
}
