<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetUserDefinedFlags;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class UserDefinedFlag implements AfterbuyDtoInterface
{
    public function __construct(
        private string $name,
        private string $color,
        private int $flagId,
    ) {
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getFlagId(): int
    {
        return $this->flagId;
    }

    public function setFlagId(int $flagId): void
    {
        $this->flagId = $flagId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
