<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum BaseProductFlagEnum: int
{
    case VARIATION = 1;
    case PRODUCT = 2;
    case LAST_ONE = 3;
}
