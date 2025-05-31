<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestDtoInterface;

final readonly class ScaledDiscount implements AfterbuyRequestDtoInterface
{
    public function __construct(
        private ?int $scaledQuantity = null,
        private ?float $scaledPrice = null,
        private ?float $scaledDPrice = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $scaledDiscount = $xml->addChild('ScaledDiscount');
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
