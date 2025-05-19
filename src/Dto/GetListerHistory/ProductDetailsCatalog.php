<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetListerHistory;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ProductDetailsCatalog implements AfterbuyDtoInterface
{
    public function __construct(
        private ?int $catalogID = null,
        private ?string $catalogPath = null,
        private ?string $catalogURL = null,
    ) {
    }

    public function getCatalogID(): ?int
    {
        return $this->catalogID;
    }

    public function setCatalogID(?int $catalogID): void
    {
        $this->catalogID = $catalogID;
    }

    public function getCatalogPath(): ?string
    {
        return $this->catalogPath;
    }

    public function setCatalogPath(?string $catalogPath): void
    {
        $this->catalogPath = $catalogPath;
    }

    public function getCatalogURL(): ?string
    {
        return $this->catalogURL;
    }

    public function setCatalogURL(?string $catalogURL): void
    {
        $this->catalogURL = $catalogURL;
    }
}
