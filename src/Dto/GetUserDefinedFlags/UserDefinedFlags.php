<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetUserDefinedFlags;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of payment services.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class UserDefinedFlags implements ResponseDtoInterface
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
