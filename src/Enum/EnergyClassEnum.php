<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum EnergyClassEnum: int
{
    case NO_CLASS = 0;
    case A_PLUS_PLUS_PLUS = 10;
    case A_PLUS_PLUS = 9;
    case A_PLUS = 8;
    case A = 7;
    case B = 6;
    case C = 5;
    case D = 4;
    case E = 3;
    case F = 2;
    case G = 1;
}
