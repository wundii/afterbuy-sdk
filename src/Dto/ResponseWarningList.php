<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ResponseWarningList implements ResponseDtoInterface
{
    /**
     * @param ResponseWarning[] $warningList
     */
    public function __construct(
        private array $warningList,
    ) {
    }

    /**
     * @return ResponseWarning[]
     */
    public function getWarningList(): array
    {
        return $this->warningList;
    }

    /**
     * @param ResponseWarning[] $warningList
     */
    public function setWarningList(array $warningList): void
    {
        $this->warningList = $warningList;
    }
}
