<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum DateFilterEnum: string
{
    case MOD_DATE = 'ModDate';
    case LAST_SALE = 'LastSale';
    case LAST_STOCK_CHANGE = 'LastStockChange';
}
