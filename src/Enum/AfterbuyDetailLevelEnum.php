<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum AfterbuyDetailLevelEnum: int
{
    case FIRST = 0;
    case SECOND = 2;
    case THIRD = 4;
    case FOURTH = 8;
    case FIFTH = 16;
    case SIXTH = 32;
    case SEVENTH = 64;
    case EIGHTH = 128;
}
