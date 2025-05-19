<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class AdditionalPrice implements AfterbuyDtoInterface
{
    public function __construct(
        private ?int $definitionId = null,
        private ?string $name = null,
        private ?float $value = null,
        private ?bool $pretax = null,
    ) {
    }

    public function getDefinitionId(): ?int
    {
        return $this->definitionId;
    }

    public function setDefinitionId(?int $definitionId): void
    {
        $this->definitionId = $definitionId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getPretax(): ?bool
    {
        return $this->pretax;
    }

    public function setPretax(?bool $pretax): void
    {
        $this->pretax = $pretax;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): void
    {
        $this->value = $value;
    }
}
