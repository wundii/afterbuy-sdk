<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateCatalogs;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use InvalidArgumentException;

final class Catalog implements AfterbuyAppendXmlContentInterface
{
    /**
     * @param Catalog[] $catalog
     */
    public function __construct(
        private ?int $catalogId = null,
        private ?string $catalogName = null,
        private ?string $catalogDescription = null,
        private ?string $additionalUrl = null,
        private ?int $level = null,
        private ?int $position = null,
        private ?string $additionalText = null,
        private ?bool $showCatalog = null,
        private ?string $picture = null,
        private ?string $mouseOverPicture = null,
        private array $catalog = [],
    ) {
        if ($catalogId === null && $catalogName === null) {
            throw new InvalidArgumentException('CatalogId or CatalogName must be set');
        }
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $catalog = $xml->addChild('Catalog');
        $catalog->addNumber('CatalogID', $this->catalogId);
        $catalog->addString('CatalogName', $this->catalogName);
        $catalog->addString('CatalogDescription', $this->catalogDescription);
        $catalog->addString('AdditionalURL', $this->additionalUrl);
        $catalog->addNumber('Level', $this->level);
        $catalog->addNumber('Position', $this->position);
        $catalog->addString('AdditionalText', $this->additionalText);
        $catalog->addBool('ShowCatalog', $this->showCatalog);
        $catalog->addString('Picture', $this->picture);
        $catalog->addString('MouseOverPicture', $this->mouseOverPicture);

        foreach ($this->catalog as $deepCatalog) {
            $deepCatalog->appendXmlContent($catalog);
        }
    }

    public function getAdditionalText(): ?string
    {
        return $this->additionalText;
    }

    public function setAdditionalText(?string $additionalText): void
    {
        $this->additionalText = $additionalText;
    }

    public function getAdditionalUrl(): ?string
    {
        return $this->additionalUrl;
    }

    public function setAdditionalUrl(?string $additionalUrl): void
    {
        $this->additionalUrl = $additionalUrl;
    }

    /**
     * @return Catalog[]
     */
    public function getCatalog(): array
    {
        return $this->catalog;
    }

    /**
     * @param Catalog[] $catalog
     */
    public function setCatalog(array $catalog): void
    {
        $this->catalog = $catalog;
    }

    public function getCatalogDescription(): ?string
    {
        return $this->catalogDescription;
    }

    public function setCatalogDescription(?string $catalogDescription): void
    {
        $this->catalogDescription = $catalogDescription;
    }

    public function getCatalogId(): ?int
    {
        return $this->catalogId;
    }

    public function setCatalogId(?int $catalogId): void
    {
        $this->catalogId = $catalogId;
    }

    public function getCatalogName(): ?string
    {
        return $this->catalogName;
    }

    public function setCatalogName(?string $catalogName): void
    {
        $this->catalogName = $catalogName;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    public function getMouseOverPicture(): ?string
    {
        return $this->mouseOverPicture;
    }

    public function setMouseOverPicture(?string $mouseOverPicture): void
    {
        $this->mouseOverPicture = $mouseOverPicture;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }

    public function getShowCatalog(): ?bool
    {
        return $this->showCatalog;
    }

    public function setShowCatalog(?bool $showCatalog): void
    {
        $this->showCatalog = $showCatalog;
    }
}
