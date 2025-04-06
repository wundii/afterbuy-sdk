<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class AddCatalog implements AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private ?int $catalogId = null,
        private ?string $catalogName = null,
        private ?int $catalogLevel = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $addCatalog = $xml->addChild('AddCatalog');
        $addCatalog->addNumber('CatalogID', $this->catalogId);
        $addCatalog->addString('CatalogName', $this->catalogName);
        $addCatalog->addNumber('CatalogLevel', $this->catalogLevel);
    }

    public function getCatalogId(): ?int
    {
        return $this->catalogId;
    }

    public function getCatalogLevel(): ?int
    {
        return $this->catalogLevel;
    }

    public function getCatalogName(): ?string
    {
        return $this->catalogName;
    }
}
