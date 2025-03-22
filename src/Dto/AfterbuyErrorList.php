<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class AfterbuyErrorList implements AfterbuyDtoInterface
{
    /**
     * @param AfterbuyError[] $errorList
     */
    public function __construct(
        private array $errorList,
    ) {
    }

    /**
     * @return AfterbuyError[]
     */
    public function getErrorList(): array
    {
        return $this->errorList;
    }

    /**
     * @param AfterbuyError[] $errorList
     */
    public function setErrorList(array $errorList): void
    {
        $this->errorList = $errorList;
    }
}
