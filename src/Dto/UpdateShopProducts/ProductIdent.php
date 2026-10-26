<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Enum\BaseProductTypeEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\Structron\Attribute\Description;

final readonly class ProductIdent implements RequestDtoXmlInterface
{
    public function __construct(
        private string $userProductId,
        private ?BaseProductTypeEnum $baseProductTypeEnum = null,
        #[Description('If true, the product is created when no existing product matches the identification (default: false)')]
        private ?bool $productInsert = null,
        #[Description('Used only to identify the product, not as a new value')]
        private ?int $productId = null,
        #[Description('Used only to identify the product, not as a new value')]
        private ?int $anr = null,
        #[Description('Used only to identify the product, not as a new value')]
        private ?string $ean = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $productIdent = $simpleXml->addChild('ProductIdent');
        $productIdent->addNumber('BaseProductType', $this->baseProductTypeEnum?->value);
        $productIdent->addBool('ProductInsert', $this->productInsert);
        $productIdent->addString('UserProductID', $this->userProductId);
        $productIdent->addNumber('ProductID', $this->productId);
        $productIdent->addNumber('Anr', $this->anr);
        $productIdent->addString('EAN', $this->ean);
    }

    public function getAnr(): ?int
    {
        return $this->anr;
    }

    public function getBaseProductType(): ?BaseProductTypeEnum
    {
        return $this->baseProductTypeEnum;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function getProductInsert(): ?bool
    {
        return $this->productInsert;
    }

    public function getUserProductId(): string
    {
        return $this->userProductId;
    }
}
