<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum BasePriceFactorEnum: string
{
    case LITER = 'L';
    case KG = 'Kg';
    case PIECE = 'Stk';
    case PAIR = 'Pr';
    case METER = 'm';
    case SQUARE_METER = 'qm';
    case PACKAGE = 'Packung';
    case GRAM = 'g';
    case MILLILITER = 'ml';
}
