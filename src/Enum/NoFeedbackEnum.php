<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum NoFeedbackEnum: int
{
    case SET_FEEDBACK_DATE_NO_EMAIL = 0;
    case NO_SET_FEEDBACK_DATE_SEND_EMAIL = 1;
    case SET_FEEDBACK_DATE_SEND_EMAIL = 2;
}
