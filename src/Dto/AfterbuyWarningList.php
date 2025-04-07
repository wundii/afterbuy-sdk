<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class AfterbuyWarningList implements AfterbuyDtoInterface
{
    /**
     * @param AfterbuyWarning[] $warningList
     */
    public function __construct(
        private array $warningList,
    ) {
    }

    /**
     * @return AfterbuyWarning[]
     */
    public function getWarningList(): array
    {
        return $this->warningList;
    }

    /**
     * @param AfterbuyWarning[] $warningList
     */
    public function setWarningList(array $warningList): void
    {
        $this->warningList = $warningList;
    }
}
