<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetStockInfo;

use AfterbuySdk\Enum\ProductFilterEnum;
use AfterbuySdk\Interface\Filter\GetStockInfoFilterInterface;

final readonly class ProductFilter implements GetStockInfoFilterInterface
{
    public function __construct(
        private ProductFilterEnum $productFilterEnum,
        private int|string $value,
    ) {
    }

    public function getName(): string
    {
        return $this->productFilterEnum->value;
    }

    public function getValue(): string
    {
        return (string) $this->value;
    }
}
