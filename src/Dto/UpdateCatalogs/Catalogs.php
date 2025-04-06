<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateCatalogs;

use AfterbuySdk\Enum\UpdateActionCatalogsEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Exception;
use Symfony\Component\Validator\Constraints as Assert;

final class Catalogs implements AfterbuyAppendXmlContentInterface
{
    private string $invalidMessage = 'Is valid was not called';

    /**
     * @param Catalog[] $catalogs
     */
    public function __construct(
        private UpdateActionCatalogsEnum $updateActionCatalogsEnum,
        private array $catalogs = [],
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $catalogs = $xml->addChild('Catalogs');
        $catalogs->addNumber('UpdateAction', $this->updateActionCatalogsEnum->value);

        foreach ($this->catalogs as $catalog) {
            $catalog->appendXmlContent($catalogs);
        }
    }

    public function getUpdateActionEnum(): UpdateActionCatalogsEnum
    {
        return $this->updateActionCatalogsEnum;
    }

    public function setUpdateActionEnum(UpdateActionCatalogsEnum $updateActionCatalogsEnum): void
    {
        $this->updateActionCatalogsEnum = $updateActionCatalogsEnum;
    }

    /**
     * @return Catalog[]
     */
    #[Assert\Count(min: 1, max: 50)]
    #[Assert\Valid]
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
        $deepCatalog = function (?Catalog $catalog) use (&$deepCatalog): void {
            if (! $catalog instanceof Catalog) {
                return;
            }

            if (
                $this->updateActionCatalogsEnum === UpdateActionCatalogsEnum::CREATE
                && $catalog->getCatalogName() === null
            ) {
                throw new Exception('Catalog name cannot be null, when creating a catalog');
            }

            if (
                $this->updateActionCatalogsEnum !== UpdateActionCatalogsEnum::CREATE
                && $catalog->getCatalogId() === null
            ) {
                throw new Exception('Catalog id cannot be null, when updating or delete a catalog');
            }

            foreach ($catalog->getCatalog() as $subCatalog) {
                $deepCatalog($subCatalog);
            }
        };

        try {
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
