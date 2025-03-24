<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class Versions implements AfterbuyDtoInterface
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
