<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum EndpointEnum: string
{
    case PROD = 'https://api.afterbuy.de/afterbuy/ABInterface.aspx';
    case SANDBOX = 'http://api.afterbuy.de/afterbuy/ABInterface.aspx';
}
