<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

interface FilterValueInterface
{
    public function getKey(): string;

    public function getValue(): string;
}
