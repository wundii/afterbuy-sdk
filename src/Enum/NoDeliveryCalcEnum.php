<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum NoDeliveryCalcEnum: int
{
    case SHIPPING_COST_CALCULATION = 0; // Shipping cost calculation on the part of Afterbuy.
    case NO_SHIPPING_COST_CALCULATION = 1; // No shipping cost calculation on the part of Afterbuy - transferred shipping costar retained.
}
