<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateCatalogs;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of payment services.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class NewCatalogs implements ResponseDtoInterface
{
    /**
     * @param NewCatalog[] $newCatalogs
     */
    public function __construct(
        private array $newCatalogs = [],
    ) {
    }

    /**
     * @return NewCatalog[]
     */
    public function getNewCatalogs(): array
    {
        return $this->newCatalogs;
    }

    /**
     * @param NewCatalog[] $newCatalogs
     */
    public function setNewCatalogs(array $newCatalogs): void
    {
        $this->newCatalogs = $newCatalogs;
    }
}
