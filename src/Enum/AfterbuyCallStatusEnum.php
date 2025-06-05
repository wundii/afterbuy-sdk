<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

use Psr\Log\LogLevel;

enum AfterbuyCallStatusEnum: string
{
    case SUCCESS = 'Success';
    case ERROR = 'Error';
    case WARNING = 'Warning';
    case UNKNOWN = 'Unknown';

    public function getPsr3Level(): string
    {
        return match ($this) {
            self::WARNING => LogLevel::WARNING,
            self::ERROR => LogLevel::ERROR,
            default => LogLevel::DEBUG,
        };
    }
}
