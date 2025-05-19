<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum DateFilterSoldItemsEnum: string
{
    case AUCTION_END_DATE = 'AuctionEndDate';
    case FEEDBACK_DATE = 'FeedbackDate';
    case INVOICE_DATE = 'InvoiceDate';
    case MAIL_DATE = 'MailDate';
    case MOD_DATE = 'ModDate';
    case PAY_DATE = 'PayDate';
    case REMINDER_DATE = 'ReminderDate';
    case SHIPPING_DATE = 'ShippingDate';
    case XML_DATE = 'XmlDate';
}
