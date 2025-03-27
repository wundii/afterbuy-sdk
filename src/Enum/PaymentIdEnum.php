<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum PaymentIdEnum: string
{
    case INVOICE = 'INVOICE';
    case CREDIT_CARD = 'CREDIT_CARD';
    case DIRECT_DEBIT = 'DIRECT_DEBIT';
}
