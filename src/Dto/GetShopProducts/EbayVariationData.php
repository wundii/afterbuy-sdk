<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class EbayVariationData implements AfterbuyDtoInterface
{
    public function __construct(
        private string $ebayVariationName,
        private string $ebayVariationValue,
    ) {
    }

    public function getEbayVariationName(): string
    {
        return $this->ebayVariationName;
    }

    public function setEbayVariationName(string $ebayVariationName): void
    {
        $this->ebayVariationName = $ebayVariationName;
    }

    public function getEbayVariationValue(): string
    {
        return $this->ebayVariationValue;
    }

    public function setEbayVariationValue(string $ebayVariationValue): void
    {
        $this->ebayVariationValue = $ebayVariationValue;
    }
}
