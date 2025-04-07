<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class Attribute implements AfterbuyDtoInterface
{
    public function __construct(
        private string $attributName,
        private string $attributWert,
        private int $attributTyp,
        private bool $attributRequired = false,
    ) {
    }

    public function getAttributName(): string
    {
        return $this->attributName;
    }

    public function setAttributName(string $attributName): void
    {
        $this->attributName = $attributName;
    }

    public function isAttributRequired(): bool
    {
        return $this->attributRequired;
    }

    public function setAttributRequired(bool $attributRequired): void
    {
        $this->attributRequired = $attributRequired;
    }

    public function getAttributTyp(): int
    {
        return $this->attributTyp;
    }

    public function setAttributTyp(int $attributTyp): void
    {
        $this->attributTyp = $attributTyp;
    }

    public function getAttributWert(): string
    {
        return $this->attributWert;
    }

    public function setAttributWert(string $attributWert): void
    {
        $this->attributWert = $attributWert;
    }
}
