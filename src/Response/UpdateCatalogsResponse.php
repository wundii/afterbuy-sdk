<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\UpdateCatalogs\CatalogNotDeleteds;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\NewCatalogs;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<NewCatalogs|CatalogNotDeleteds>
 */
final class UpdateCatalogsResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return NewCatalogs|CatalogNotDeleteds
     */
    public function getResult(): ResponseDtoInterface
    {
        if (str_contains($this->content, 'CatalogNotDeleted')) {
            return $this->dataMapper->xml($this->content, CatalogNotDeleteds::class, ['Result']);
        }

        return $this->dataMapper->xml($this->content, NewCatalogs::class, ['Result'], true);
    }
}
