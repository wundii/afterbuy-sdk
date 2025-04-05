<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum UpdateActionAddBaseProductEnum: int
{
    /** Create and assign set assignments if they do not exist. */
    case UPDATE = 1;
    /** Remove old assignments and assign transferred set items. */
    case REPLACE = 2;
}
