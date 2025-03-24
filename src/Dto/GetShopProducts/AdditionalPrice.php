<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShopProducts;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class AdditionalPrice implements AfterbuyDtoInterface
{
    public function __construct(
        private int $definitionId,
        private string $name,
        private float $value,
        private bool $pretax,
    ) {
    }

    public function getDefinitionId(): int
    {
        return $this->definitionId;
    }

    public function setDefinitionId(int $definitionId): void
    {
        $this->definitionId = $definitionId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPretax(): bool
    {
        return $this->pretax;
    }

    public function setPretax(bool $pretax): void
    {
        $this->pretax = $pretax;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }
}
