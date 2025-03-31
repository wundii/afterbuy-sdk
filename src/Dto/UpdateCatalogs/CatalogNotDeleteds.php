<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateCatalogs;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class CatalogNotDeleteds implements AfterbuyDtoInterface
{
    /**
     * @param CatalogNotDeleted[] $catalogNotDeleteds
     */
    public function __construct(
        private array $catalogNotDeleteds = [],
    ) {
    }

    /**
     * @return CatalogNotDeleted[]
     */
    public function getCatalogNotDeleteds(): array
    {
        return $this->catalogNotDeleteds;
    }

    /**
     * @param CatalogNotDeleted[] $catalogNotDeleteds
     */
    public function setCatalogNotDeleteds(array $catalogNotDeleteds): void
    {
        $this->catalogNotDeleteds = $catalogNotDeleteds;
    }
}
