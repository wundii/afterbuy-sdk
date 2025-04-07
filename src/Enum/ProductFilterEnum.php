<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum ProductFilterEnum: string
{
    case ANR = 'Anr';
    case PRODUCTID = 'ProductID';
    case EAN = 'EAN';
}
