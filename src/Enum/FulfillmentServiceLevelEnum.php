<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum FulfillmentServiceLevelEnum: int
{
    case NONE = 0;
    case STANDARD = 1;
    case EXPEDITED = 2;
    case SCHEDULED = 3;
    case NEXT = 10;
    case NEXTDAY = 11;
    case SECOND = 20;
    case SECONDDAY = 21;
}
