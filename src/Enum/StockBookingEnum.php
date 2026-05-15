<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum StockBookingEnum: int
{
    case NO_BOOKING = -1;
    case SHOP = 0;
    case AUCTION = 1;
}
