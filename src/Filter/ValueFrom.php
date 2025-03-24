<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter;

use AfterbuySdk\Interface\FilterValueInterface;

final readonly class ValueFrom implements FilterValueInterface
{
    public function __construct(
        private string $value
    ) {
    }

    public function getKey(): string
    {
        return 'ValueFrom';
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
