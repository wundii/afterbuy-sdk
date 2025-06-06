<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class ScaledDiscount implements RequestDtoXmlInterface
{
    public function __construct(
        private ?int $scaledQuantity = null,
        private ?float $scaledPrice = null,
        private ?float $scaledDPrice = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $scaledDiscount = $simpleXml->addChild('ScaledDiscount');
        $scaledDiscount->addNumber('ScaledQuantity', $this->scaledQuantity);
        $scaledDiscount->addNumber('ScaledPrice', $this->scaledPrice);
        $scaledDiscount->addNumber('ScaledDPrice', $this->scaledDPrice);
    }

    public function getScaledDPrice(): ?float
    {
        return $this->scaledDPrice;
    }

    public function getScaledPrice(): ?float
    {
        return $this->scaledPrice;
    }

    public function getScaledQuantity(): ?int
    {
        return $this->scaledQuantity;
    }
}
