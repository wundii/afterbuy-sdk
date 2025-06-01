<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class AddCatalog implements RequestDtoXmlInterface
{
    public function __construct(
        private ?int $catalogId = null,
        private ?string $catalogName = null,
        private ?int $catalogLevel = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $addCatalog = $simpleXml->addChild('AddCatalog');
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
