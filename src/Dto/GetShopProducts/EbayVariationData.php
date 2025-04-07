<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class EbayVariationData implements AfterbuyDtoInterface
{
    public function __construct(
        private string $eBayVariationName,
        private string $eBayVariationValue,
    ) {
    }

    public function getEBayVariationName(): string
    {
        return $this->eBayVariationName;
    }

    public function setEBayVariationName(string $eBayVariationName): void
    {
        $this->eBayVariationName = $eBayVariationName;
    }

    public function getEBayVariationValue(): string
    {
        return $this->eBayVariationValue;
    }

    public function setEBayVariationValue(string $eBayVariationValue): void
    {
        $this->eBayVariationValue = $eBayVariationValue;
    }
}
