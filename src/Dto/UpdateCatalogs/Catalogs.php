<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateCatalogs;

use AfterbuySdk\Enum\UpdateActionCatalogsEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class Catalogs implements AfterbuyAppendXmlContentInterface
{
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
}
