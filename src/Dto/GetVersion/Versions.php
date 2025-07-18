<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetVersion;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of payment services.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class Versions implements ResponseDtoInterface
{
    /**
     * @param Version[] $versions
     */
    public function __construct(
        private array $versions = [],
    ) {
    }

    /**
     * @return Version[]
     */
    public function getVersions(): array
    {
        return $this->versions;
    }

    /**
     * @param Version[] $versions
     */
    public function setVersions(array $versions): void
    {
        $this->versions = array_merge($this->versions, $versions);
    }

    public function getLastVersion(): Version|null
    {
        return end($this->versions) ?: null;
    }
}
