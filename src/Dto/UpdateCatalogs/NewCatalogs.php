<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateCatalogs;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class NewCatalogs implements AfterbuyDtoInterface
{
    /**
     * @param NewCatalog[] $newCatalogs
     */
    public function __construct(
        private array $newCatalogs = [],
    ) {
    }

    /**
     * @return NewCatalog[]
     */
    public function getNewCatalogs(): array
    {
        return $this->newCatalogs;
    }

    /**
     * @param NewCatalog[] $newCatalogs
     */
    public function setNewCatalogs(array $newCatalogs): void
    {
        $this->newCatalogs = $newCatalogs;
    }
}
