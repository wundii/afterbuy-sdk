<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetListerHistory;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\Structron\Attribute\Description;

final class ProductDetails implements ResponseDtoInterface
{
    /**
     * @param ProductDetailsCatalog[] $catalogs
     */
    public function __construct(
        #[Description('Stammartikel name')]
        private string $name,
        #[Description('Short description of the Stammartikel')]
        private ?string $shortDescription = null,
        #[Description('Container with shop catalogs')]
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
