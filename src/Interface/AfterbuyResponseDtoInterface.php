<?php

declare(strict_types=1);

namespace AfterbuySdk\Interface;

/**
 * @template T of object
 */
interface AfterbuyResponseDtoInterface
{
    public function getResponse(): AfterbuyDtoInterface;
}
