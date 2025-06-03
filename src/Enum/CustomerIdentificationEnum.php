<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum CustomerIdentificationEnum: int
{
    case EBAY_NAME = 0;
    case EMAIL_ADDRESS = 1;
    case OWN_CUSTOMER_NUMBER = 2;
}
