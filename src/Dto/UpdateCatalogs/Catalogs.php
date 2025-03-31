<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateCatalogs;

use AfterbuySdk\Enum\UpdateActionEnum;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use Exception;

final class Catalogs implements AfterbuyDtoInterface
{
    private string $invalidMessage = 'Is valid was not called';

    /**
     * @param Catalog[] $catalogs
     */
    public function __construct(
        private UpdateActionEnum $updateActionEnum,
        private array $catalogs = [],
    ) {
    }

    public function getUpdateActionEnum(): UpdateActionEnum
    {
        return $this->updateActionEnum;
    }

    public function setUpdateActionEnum(UpdateActionEnum $updateActionEnum): void
    {
        $this->updateActionEnum = $updateActionEnum;
    }

    /**
     * @return Catalog[]
     */
    public function getCatalogs(): array
    {
        return $this->catalogs;
    }

    /**
     * @param Catalog[] $catalogs
     */
    public function setCatalogs(array $catalogs): void
    {
        $this->catalogs = $catalogs;
    }

    public function isValid(): bool
    {
        $deepCatalog = function (?Catalog $catalog, int $deepCount) use (&$deepCatalog): void {
            ++$deepCount;

            if ($deepCount >= 50) {
                throw new Exception('Catalogs can not be nested more than 50 levels deep');
            }

            if (! $catalog instanceof Catalog) {
                return;
            }

            foreach ($catalog->getCatalog() as $subCatalog) {
                $deepCatalog($subCatalog, $deepCount);
            }
        };

        try {
            $deepCount = 0;
            foreach ($this->catalogs as $catalog) {
                $deepCatalog($catalog, $deepCount);
            }
        } catch (Exception $exception) {
            $this->invalidMessage = $exception->getMessage();

            return false;
        }

        return true;
    }

    public function getInvalidMessage(): string
    {
        return $this->invalidMessage;
    }
}
