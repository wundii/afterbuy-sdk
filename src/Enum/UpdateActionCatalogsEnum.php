<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum UpdateActionCatalogsEnum: int
{
    /** All transferred catalogs are created without checking whether a catalog already exists. */
    case CREATE = 1;
    /** Based on the CatalogID, existing catalogs and sub-catalogs are searched. If they are found, they will be updated, if not, they will be created again. */
    case REFRESH = 2;
    /** Based on the CatalogID, existing catalogs are searched and deleted with all sub-catalogs. */
    case DELETE = 3;
}
