<?php

declare(strict_types=1);

namespace AfterbuySdk\Interface;

interface FilterInterface
{
    public function getFilterName(): string;

    /**
     * @return FilterValueInterface[]
     */
    public function getFilterValues(): array;
}
