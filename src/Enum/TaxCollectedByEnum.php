<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum TaxCollectedByEnum: int
{
    case DEFAULT = 0;
    case MARKETPLACE = 1;
}
