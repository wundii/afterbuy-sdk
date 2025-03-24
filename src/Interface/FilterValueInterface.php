<?php

declare(strict_types=1);

namespace AfterbuySdk\Interface;

interface FilterValueInterface
{
    public function getKey(): string;

    public function getValue(): string;
}
