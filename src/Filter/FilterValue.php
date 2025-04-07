<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter;

use Wundii\AfterbuySdk\Interface\FilterValueInterface;

final readonly class FilterValue implements FilterValueInterface
{
    public function __construct(
        private string $value
    ) {
    }

    public function getKey(): string
    {
        return 'FilterValue';
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
