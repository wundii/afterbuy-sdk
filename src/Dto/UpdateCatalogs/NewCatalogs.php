<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateCatalogs;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class NewCatalogs implements ResponseDtoInterface
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
