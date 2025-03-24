<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShopCatalogs;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class Catalog implements AfterbuyDtoInterface
{
    /**
     * @param int[] $catalogProducts
     */
    public function __construct(
        private int $catalogId,
        private string $name,
        private string $description,
        private int $parnetId,
        private int $level,
        private int $position,
        private ?string $additionalText = null,
        private bool $show = false,
        private ?string $picture1 = null,
        private ?string $picture2 = null,
        private ?string $titlePicture = null,
        private array $catalogProducts = [],
    ) {
    }

    public function getAdditionalText(): ?string
    {
        return $this->additionalText;
    }

    public function setAdditionalText(?string $additionalText): void
    {
        $this->additionalText = $additionalText;
    }

    public function getCatalogId(): int
    {
        return $this->catalogId;
    }

    public function setCatalogId(int $catalogId): void
    {
        $this->catalogId = $catalogId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getParnetId(): int
    {
        return $this->parnetId;
    }

    public function setParnetId(int $parnetId): void
    {
        $this->parnetId = $parnetId;
    }

    public function getPicture1(): ?string
    {
        return $this->picture1;
    }

    public function setPicture1(?string $picture1): void
    {
        $this->picture1 = $picture1;
    }

    public function getPicture2(): ?string
    {
        return $this->picture2;
    }

    public function setPicture2(?string $picture2): void
    {
        $this->picture2 = $picture2;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function isShow(): bool
    {
        return $this->show;
    }

    public function setShow(bool $show): void
    {
        $this->show = $show;
    }

    public function getTitlePicture(): ?string
    {
        return $this->titlePicture;
    }

    public function setTitlePicture(?string $titlePicture): void
    {
        $this->titlePicture = $titlePicture;
    }

    /**
     * @return int[]
     */
    public function getCatalogProducts(): array
    {
        return $this->catalogProducts;
    }

    /**
     * @param int[] $catalogProducts
     */
    public function setCatalogProducts(array $catalogProducts): void
    {
        $this->catalogProducts = $catalogProducts;
    }
}
