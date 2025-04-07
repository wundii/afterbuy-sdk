<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum AgeGroupEnum: int
{
    case ADULTS = 1;
    case KIDS = 2;
    case TEENS = 3;
    case INFANTS = 4;
    case NEWBORNS = 5;
}
