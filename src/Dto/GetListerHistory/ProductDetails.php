<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetListerHistory;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ProductDetails implements AfterbuyDtoInterface
{
    /**
     * @param ProductDetailsCatalog[] $catalogs
     */
    public function __construct(
        private string $name,
        private ?string $shortDescription = null,
        private array $catalogs = [],
    ) {
    }

    /**
     * @return ProductDetailsCatalog[]
     */
    public function getCatalogs(): array
    {
        return $this->catalogs;
    }

    /**
     * @param ProductDetailsCatalog[] $catalogs
     */
    public function setCatalogs(array $catalogs): void
    {
        $this->catalogs = $catalogs;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }
}
