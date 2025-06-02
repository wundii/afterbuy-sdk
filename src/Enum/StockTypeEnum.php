<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum StockTypeEnum: string
{
    case AUCTION = 'auktion';
    case SHOP = 'shop';
}
