<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Extension;

use DateTime as DateTimeBase;
use DateTimeZone;
use Exception;

final class DateTime extends DateTimeBase
{
    public function __construct(
        string $datetime = 'now'
    ) {
        try {
            parent::__construct($datetime, new DateTimeZone('Europe/Berlin'));
        } catch (Exception) {
            parent::__construct($datetime);
        }
    }
}
