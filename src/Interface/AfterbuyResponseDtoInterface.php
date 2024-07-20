<?php

declare(strict_types=1);

namespace AfterbuySdk\Interface;

interface AfterbuyResponseDtoInterface
{
    public function getResponse(): AfterbuyDtoInterface;
}
