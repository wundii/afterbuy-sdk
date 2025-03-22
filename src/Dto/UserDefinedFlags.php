<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class UserDefinedFlags implements AfterbuyDtoInterface
{
    /**
     * @param UserDefinedFlag[] $userDefinedFlags
     */
    public function __construct(
        private array $userDefinedFlags = [],
    ) {
    }

    /**
     * @return UserDefinedFlag[]
     */
    public function getUserDefinedFlags(): array
    {
        return $this->userDefinedFlags;
    }

    /**
     * @param UserDefinedFlag[] $userDefinedFlags
     */
    public function setUserDefinedFlags(array $userDefinedFlags): void
    {

        $this->userDefinedFlags = array_merge($this->userDefinedFlags, $userDefinedFlags);
    }
}
