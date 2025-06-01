<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateCatalogs;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class NewCatalog implements ResponseDtoInterface
{
    /**
     * @param NewCatalog[] $newCatalog
     */
    public function __construct(
        private int $catalogId,
        private string $catalogName,
        private ?int $catalogIdRequested = null,
        private array $newCatalog = [],
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

    public function getCatalogIdRequested(): ?int
    {
        return $this->catalogIdRequested;
    }

    public function setCatalogIdRequested(?int $catalogIdRequested): void
    {
        $this->catalogIdRequested = $catalogIdRequested;
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
     * @return NewCatalog[]
     */
    public function getNewCatalog(): array
    {
        return $this->newCatalog;
    }

    public function setNewCatalog(?self $newCatalog): void
    {
        if (! $newCatalog instanceof self) {
            return;
        }

        $this->newCatalog[] = $newCatalog;
    }
}
