<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum UpdateActionSkusEnum: int
{
    /** Add new SKU assignments to existing ones. Only 10 SKUs can be assigned in total */
    case ADD = 1;
    /** Remove old SKU assignments and reassign transferred ones. Only 10 SKUs can be assigned in total */
    case REPLACE = 2;
    /** Delete old SKU assignments. Does not create new ones */
    case DELETE = 3;
}
