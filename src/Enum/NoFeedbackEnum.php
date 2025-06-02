<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum NoFeedbackEnum: int
{
    case SET_FEEDBACK_DATE_NO_EMAIL = 0; // Set a feedback date (do not send email).
    case NO_SET_FEEDBACK_DATE_SEND_EMAIL = 1; // Do not set a feedback date (send email)
    case SET_FEEDBACK_DATE_SEND_EMAIL = 2; // Set a feedback date (send email)
}
