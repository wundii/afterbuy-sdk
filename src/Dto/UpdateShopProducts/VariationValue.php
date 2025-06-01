<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class VariationValue implements RequestDtoXmlInterface
{
    public function __construct(
        private ?int $validForProdId = null,
        private ?string $variationValue = null,
        private ?int $variationPos = null,
        private ?string $variationPicUrl = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $variationValues = $simpleXml->addChild('VariationValues');
        $variationValues->addNumber('ValidForProdID', $this->validForProdId);
        $variationValues->addString('VariationValue', $this->variationValue);
        $variationValues->addNumber('VariationPos', $this->variationPos);
        $variationValues->addString('VariationPicURL', $this->variationPicUrl);
    }

    public function getValidForProdId(): ?int
    {
        return $this->validForProdId;
    }

    public function getVariationPicUrl(): ?string
    {
        return $this->variationPicUrl;
    }

    public function getVariationPos(): ?int
    {
        return $this->variationPos;
    }

    public function getVariationValue(): ?string
    {
        return $this->variationValue;
    }
}
