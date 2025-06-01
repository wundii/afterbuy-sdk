<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ResponseErrorList implements ResponseDtoInterface
{
    /**
     * @param ResponseError[] $errorList
     */
    public function __construct(
        private array $errorList,
    ) {
    }

    /**
     * @return ResponseError[]
     */
    public function getErrorList(): array
    {
        return $this->errorList;
    }

    /**
     * @param ResponseError[] $errorList
     */
    public function setErrorList(array $errorList): void
    {
        $this->errorList = $errorList;
    }
}
