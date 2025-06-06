<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateCatalogs;

use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\UpdateActionCatalogsEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\AfterbuySdk\Validator as AfterbuySdkAssert;

final class Catalog implements RequestDtoXmlInterface
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

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $catalog = $simpleXml->addChild('Catalog');
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
    #[Assert\Count(min: 0)]
    #[Assert\Valid]
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

    #[Assert\Length(max: 255)]
    public function getCatalogDescription(): ?string
    {
        return $this->catalogDescription;
    }

    public function setCatalogDescription(?string $catalogDescription): void
    {
        $this->catalogDescription = $catalogDescription;
    }

    #[AfterbuySdkAssert\NotNullDependentFromRoot(
        propertyPath: 'getUpdateActionEnum',
        propertyValue: UpdateActionCatalogsEnum::CREATE,
        message: '{{ source }} must not be empty, when refresh or delete a catalog.'
    )]
    public function getCatalogId(): ?int
    {
        return $this->catalogId;
    }

    public function setCatalogId(?int $catalogId): void
    {
        $this->catalogId = $catalogId;
    }

    #[AfterbuySdkAssert\NotNullDependentFromRoot(
        propertyPath: 'getUpdateActionEnum',
        propertyValue: UpdateActionCatalogsEnum::REFRESH,
        message: '{{ source }} must not be empty, when creating a catalog.',
    )]
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
