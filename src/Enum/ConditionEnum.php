<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum ConditionEnum: int
{
    case NO_CONDITION = 0;
    case NEW = 1;
    case USED = 2;
    case REFURBISHED = 3;
}
