<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum SellStatusEnum: string
{
    // case SUCCESSFUL = 'successful';
    // case UNSUCCESSFUL = 'unsuccessful';
    case ERFOLGREICH = 'erfolgreich';
    case ERFOLGLOS = 'erfolglos';
    case EMPTY = '';
}
