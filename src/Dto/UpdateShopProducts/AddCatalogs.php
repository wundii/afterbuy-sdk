<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Enum\UpdateActionAddCatalogsEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use InvalidArgumentException;

final readonly class AddCatalogs implements AfterbuyAppendXmlContentInterface
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

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $addCatalogs = $xml->addChild('AddCatalogs');
        $addCatalogs->addNumber('UpdateAction', $this->updateActionAddCatalogsEnum->value);
        foreach ($this->addCatalog as $addCatalog) {
            $addCatalog->appendXmlContent($addCatalogs);
        }
    }

    /**
     * @return AddCatalog[]
     */
    public function getAddCatalog(): array
    {
        return $this->addCatalog;
    }

    public function getUpdateActionAddCatalogsEnum(): UpdateActionAddCatalogsEnum
    {
        return $this->updateActionAddCatalogsEnum;
    }
}
