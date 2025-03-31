<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum CallStatusEnum: string
{
    case SUCCESS = 'Success';
    case ERROR = 'Error';
    case WARNING = 'Warning';
    case UNKNOWN = 'Unknown';
}
