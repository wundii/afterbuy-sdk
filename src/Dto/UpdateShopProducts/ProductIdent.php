<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Enum\BaseProductTypeEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class ProductIdent implements AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private ?BaseProductTypeEnum $baseProductTypeEnum = null,
        private ?bool $productInsert = null,
        private ?string $userProductId = null,
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

    public function getUserProductId(): ?string
    {
        return $this->userProductId;
    }
}
