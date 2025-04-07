<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum UpdateActionAddCatalogsEnum: int
{
    /** Assigns catalogue. If catalogue does not exist, it will be created provided that ‘CatalogName’ is supplied. */
    case UPDATE = 1;
    /** Replaces previously assigned catalogues with newly provided ones */
    case REPLACE = 2;
    /** Removes all assignments */
    case DELETE = 3;
}
