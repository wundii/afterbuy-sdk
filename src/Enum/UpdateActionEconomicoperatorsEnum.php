<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum UpdateActionEconomicoperatorsEnum: int
{
    case ADD = 1;
    case REPLACE = 2;
    case DELETE = 3;
    case DELETE_ALL = 4;
}
