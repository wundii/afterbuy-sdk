<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum PaymentFunctionEnum: string
{
    case TRANSFER = 'TRANSFER';
    case CASH = 'CASH';
    case CASH_ON_DELIVERY = 'CASH_ON_DELIVERY';
    case PAYPAL = 'PAYPAL';
    case INVOICE_TRANSFER = 'INVOICE_TRANSFER';
    case DIRECT_DEBIT = 'DIRECT_DEBIT';
    case CLICKANDBUY = 'CLICKANDBUY';
    case EXPRESS_CREDITWORTHINESS = 'EXPRESS_CREDITWORTHINESS';
    case PAYNET = 'PAYNET';
    case COD_CREDITWORTHINESS = 'COD_CREDITWORTHINESS';
    case EBAY_EXPRESS = 'EBAY_EXPRESS';
    case MONEYBOOKERS = 'MONEYBOOKERS';
    case CREDIT_CARD_MB = 'CREDIT_CARD_MB';
    case DIRECT_DEBIT_MB = 'DIRECT_DEBIT_MB';
    case OTHERS = 'OTHERS';
}
