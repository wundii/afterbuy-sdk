<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class AddCatalog implements AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private ?string $catalogId = null,
        private ?string $catalogName = null,
        private ?int $catalogLevel = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $addCatalog = $xml->addChild('AddCatalog');
        $addCatalog->addString('CatalogID', $this->catalogId);
        $addCatalog->addString('CatalogName', $this->catalogName);
        $addCatalog->addNumber('CatalogLevel', $this->catalogLevel);
    }

    public function getCatalogId(): ?string
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
