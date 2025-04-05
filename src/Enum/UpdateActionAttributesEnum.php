<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum UpdateActionAttributesEnum: int
{
    /** Add new attribute (if this does not exist yet) and assign to product. */
    /** Updates attributes or add new attribute (if this does not exist yet) and assign to product. */
    case ADD_OR_UPDATE = 1;
    /** Replaces previously assigned attributes with newly provided ones */
    case REPLACE = 2;
    /** Removes all attribute assignments */
    case DELETE = 3;
}
