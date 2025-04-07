<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum UpdateActionEconomicoperatorsEnum: int
{
    /** Add new existing economic operator to product. */
    case ADD = 1;
    /** Remove old economic operator assignments and reassign transferred ones. */
    case REPLACE = 2;
    /** Delete transferred economic operators from product. */
    case DELETE = 3;
    /** Delete all economic operators from product. */
    case DELETE_ALL = 4;
}
