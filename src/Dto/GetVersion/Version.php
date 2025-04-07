<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetVersion;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class Version implements AfterbuyDtoInterface
{
    public function __construct(
        private int $id,
        private string $name,
        private string $description,
    ) {
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
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
