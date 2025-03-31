<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShopCatalogs;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class Catalogs implements AfterbuyDtoInterface
{
    /**
     * @param Catalog[] $catalogs
     */
    public function __construct(
        private int $hasMoreCatalogs,
        private array $catalogs,
    ) {
    }

    public function serializeToUpdateCatalogs(): array
    {
        return array_map(fn (Catalog $catalog) => $catalog->serializeToUpdateCatalog(), $this->catalogs);
    }

    public function getHasMoreCatalogs(): int
    {
        return $this->hasMoreCatalogs;
    }

    public function setHasMoreCatalogs(int $hasMoreCatalogs): void
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
