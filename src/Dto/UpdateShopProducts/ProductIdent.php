<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Enum\BaseProductTypeEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class ProductIdent implements AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private ?BaseProductTypeEnum $baseProductTypeEnum = null,
        private ?bool $productInsert = null,
        private ?int $userProductId = null,
        private ?int $productId = null,
        private ?int $anr = null,
        private ?string $ean = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $productIdent = $xml->addChild('ProductIdent');
        $productIdent->addNumber('BaseProductType', $this->baseProductTypeEnum?->value);
        $productIdent->addBool('ProductInsert', $this->productInsert);
        $productIdent->addNumber('UserProductID', $this->userProductId);
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

    public function getUserProductId(): ?int
    {
        return $this->userProductId;
    }
}
