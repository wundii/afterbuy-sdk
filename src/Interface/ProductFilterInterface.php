<?php

declare(strict_types=1);

namespace AfterbuySdk\Interface;

interface ProductFilterInterface
{
    public function getName(): string;

    public function getValue(): string;
}
