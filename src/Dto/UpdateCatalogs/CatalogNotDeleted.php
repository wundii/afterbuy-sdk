<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateCatalogs;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class CatalogNotDeleted implements ResponseDtoInterface
{
    /**
     * @param CatalogNotDeleted[] $catalogNotDeleted
     */
    public function __construct(
        private int $catalogId,
        private string $catalogName,
        private array $catalogNotDeleted = [],
    ) {
    }

    public function getCatalogId(): int
    {
        return $this->catalogId;
    }

    public function setCatalogId(int $catalogId): void
    {
        $this->catalogId = $catalogId;
    }

    public function getCatalogName(): string
    {
        return $this->catalogName;
    }

    public function setCatalogName(string $catalogName): void
    {
        $this->catalogName = $catalogName;
    }

    /**
     * @return CatalogNotDeleted[]
     */
    public function getCatalogNotDeleted(): array
    {
        return $this->catalogNotDeleted;
    }

    public function setCatalogNotDeleted(?self $catalogNotDeleted): void
    {
        if (! $catalogNotDeleted instanceof self) {
            return;
        }

        $this->catalogNotDeleted[] = $catalogNotDeleted;
    }
}
