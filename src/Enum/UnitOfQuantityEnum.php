<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum UnitOfQuantityEnum: string
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
