<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetListerHistory;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ProductDetailsCatalog implements AfterbuyDtoInterface
{
    public function __construct(
        private int $catalogID,
        private int $catalogPath,
        private int $catalogURL,
    ) {
    }

    public function getCatalogID(): int
    {
        return $this->catalogID;
    }

    public function setCatalogID(int $catalogID): void
    {
        $this->catalogID = $catalogID;
    }

    public function getCatalogPath(): int
    {
        return $this->catalogPath;
    }

    public function setCatalogPath(int $catalogPath): void
    {
        $this->catalogPath = $catalogPath;
    }

    public function getCatalogURL(): int
    {
        return $this->catalogURL;
    }

    public function setCatalogURL(int $catalogURL): void
    {
        $this->catalogURL = $catalogURL;
    }
}
