<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateCatalogs;

use AfterbuySdk\Enum\UpdateActionCatalogEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Exception;

final class Catalogs implements AfterbuyAppendXmlContentInterface
{
    private string $invalidMessage = 'Is valid was not called';

    /**
     * @param Catalog[] $catalogs
     */
    public function __construct(
        private UpdateActionCatalogEnum $updateActionCatalogEnum,
        private array $catalogs = [],
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $catalogs = $xml->addChild('Catalogs');
        $catalogs->addNumber('UpdateAction', $this->updateActionCatalogEnum->value);

        foreach ($this->catalogs as $catalog) {
            $catalog->appendXmlContent($catalogs);
        }
    }

    public function getUpdateActionEnum(): UpdateActionCatalogEnum
    {
        return $this->updateActionCatalogEnum;
    }

    public function setUpdateActionEnum(UpdateActionCatalogEnum $updateActionCatalogEnum): void
    {
        $this->updateActionCatalogEnum = $updateActionCatalogEnum;
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
        $deepCatalog = function (?Catalog $catalog) use (&$deepCatalog, &$catalogCount): void {
            if (! $catalog instanceof Catalog) {
                return;
            }

            ++$catalogCount;
            if ($catalogCount > 50) {
                throw new Exception('Catalogs can not contain more than 50 catalogs');
            }

            if (
                $this->updateActionCatalogEnum === UpdateActionCatalogEnum::CREATE
                && $catalog->getCatalogName() === null
            ) {
                throw new Exception('Catalog name cannot be null, when creating a catalog');
            }

            if (
                $this->updateActionCatalogEnum !== UpdateActionCatalogEnum::CREATE
                && $catalog->getCatalogId() === null
            ) {
                throw new Exception('Catalog id cannot be null, when updating or delete a catalog');
            }

            if ($catalog->getCatalogDescription() !== null && strlen($catalog->getCatalogDescription()) > 255) {
                throw new Exception('Catalog description cannot be longer than 255 characters');
            }

            foreach ($catalog->getCatalog() as $subCatalog) {
                $deepCatalog($subCatalog);
            }
        };

        try {
            $catalogCount = 0;
            foreach ($this->catalogs as $catalog) {
                $deepCatalog($catalog);
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
