<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class AfterbuyError implements AfterbuyDtoInterface
{
    public function __construct(
        private int $errorCode,
        private string $errorDescription,
        private string $errorLongDescription,
    ) {
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    public function setErrorCode(int $errorCode): void
    {
        $this->errorCode = $errorCode;
    }

    public function getErrorDescription(): string
    {
        return $this->errorDescription;
    }

    public function setErrorDescription(string $errorDescription): void
    {
        $this->errorDescription = $errorDescription;
    }

    public function getErrorLongDescription(): string
    {
        return $this->errorLongDescription;
    }

    public function setErrorLongDescription(string $errorLongDescription): void
    {
        $this->errorLongDescription = $errorLongDescription;
    }
}
