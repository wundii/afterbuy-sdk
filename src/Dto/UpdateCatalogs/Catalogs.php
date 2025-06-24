<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateCatalogs;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\UpdateActionCatalogsEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of payment services.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class Catalogs implements RequestDtoXmlInterface
{
    /**
     * @param Catalog[] $catalogs
     */
    public function __construct(
        private UpdateActionCatalogsEnum $updateActionCatalogsEnum,
        private array $catalogs = [],
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $catalogs = $simpleXml->addChild('Catalogs');
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
