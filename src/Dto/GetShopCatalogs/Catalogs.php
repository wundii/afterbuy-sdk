<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShopCatalogs;

use AfterbuySdk\Dto\UpdateCatalogs\Catalog as UpdateCatalog;
use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class Catalogs implements AfterbuyDtoInterface
{
    /**
     * @param Catalog[] $catalogs
     */
    public function __construct(
        private bool $hasMoreCatalogs = false,
        private array $catalogs = [],
    ) {
    }

    /**
     * @return UpdateCatalog[]
     */
    public function serializeToUpdateCatalogs(): array
    {
        return array_map(fn (Catalog $catalog): UpdateCatalog => $catalog->serializeToUpdateCatalog(), $this->catalogs);
    }

    public function hasMoreCatalogs(): bool
    {
        return $this->hasMoreCatalogs;
    }

    public function setHasMoreCatalogs(bool $hasMoreCatalogs): void
    {
        $this->hasMoreCatalogs = $hasMoreCatalogs;
    }

    /**
     * @return Catalog[]
     */
    public function getCatalogs(): array
    {
        return $this->catalogs;
    }

    /**
     * @param Catalog[] $catalogs
     */
    public function setCatalogs(array $catalogs): void
    {
        $this->catalogs = $catalogs;
    }
}
