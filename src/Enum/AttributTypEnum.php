<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum AttributTypEnum: int
{
    case TEXT = 0;
    case TEXT_FIELD = 1;
    case DROPDOWN = 2;
    case LINK = 3;
}
