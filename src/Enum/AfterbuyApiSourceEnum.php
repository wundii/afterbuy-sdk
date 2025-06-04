<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum AfterbuyApiSourceEnum: string
{
    case SHOP = 'shop';
    case XML = 'XML';
}
