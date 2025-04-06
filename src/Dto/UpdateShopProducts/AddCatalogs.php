<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Enum\UpdateActionAddCatalogsEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;

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
