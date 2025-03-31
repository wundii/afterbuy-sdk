<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class AfterbuyWarning implements AfterbuyDtoInterface
{
    public function __construct(
        private int $warningCode,
        private string $warningDescription,
        private string $warningLongDescription,
        private ?int $productId = null,
    ) {
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
    }

    public function getWarningCode(): int
    {
        return $this->warningCode;
    }

    public function setWarningCode(int $warningCode): void
    {
        $this->warningCode = $warningCode;
    }

    public function getWarningDescription(): string
    {
        return $this->warningDescription;
    }

    public function setWarningDescription(string $warningDescription): void
    {
        $this->warningDescription = $warningDescription;
    }

    public function getWarningLongDescription(): string
    {
        return $this->warningLongDescription;
    }

    public function setWarningLongDescription(string $warningLongDescription): void
    {
        $this->warningLongDescription = $warningLongDescription;
    }
}
