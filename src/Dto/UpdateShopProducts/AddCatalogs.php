<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\UpdateActionAddCatalogsEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class AddCatalogs implements RequestDtoXmlInterface
{
    /**
     * @param AddCatalog[] $addCatalog
     */
    public function __construct(
        private UpdateActionAddCatalogsEnum $updateActionAddCatalogsEnum,
        private array $addCatalog,
    ) {
        if ($this->addCatalog === []) {
            throw new InvalidArgumentException('The addCatalog array must not be empty.');
        }
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $addCatalogs = $simpleXml->addChild('AddCatalogs');
        $addCatalogs->addNumber('UpdateAction', $this->updateActionAddCatalogsEnum->value);
        foreach ($this->addCatalog as $addCatalog) {
            $addCatalog->appendXmlContent($addCatalogs);
        }
    }

    /**
     * @return AddCatalog[]
     */
    #[Assert\Count(min: 1)]
    #[Assert\Valid]
    public function getAddCatalog(): array
    {
        return $this->addCatalog;
    }

    public function getUpdateActionAddCatalogsEnum(): UpdateActionAddCatalogsEnum
    {
        return $this->updateActionAddCatalogsEnum;
    }
}
