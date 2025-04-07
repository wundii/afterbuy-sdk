<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter;

use Wundii\AfterbuySdk\Interface\FilterValueInterface;

final readonly class ProductValue implements FilterValueInterface
{
    public function __construct(
        private string $key,
        private string $value,
    ) {
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
