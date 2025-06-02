<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum PaymentMethodIdEnum: int
{
    case BANK_TRANSFER = 1;
    case CASH = 2;
    case CASH_ON_DELIVERY = 4;
    case PAYPAL = 5;
    case BANK_TRANSFER_INVOICE = 6;
    case DIRECT_DEBIT = 7;
    case CLICK_AND_BUY = 9;
    case EXPRESS_PURCHASE_BONICHECK = 11;
    case INSTANT_BANK_TRANSFER = 12;
    case CASH_ON_DELIVERY_CREDITWORTHINESS_CHECK = 13;
    case EBAY_EXPRESS = 14;
    case MONEYBOOKERS = 15;
    case CREDIT_CARD = 16;
    case DIRECT_DEBIT_MB = 17;
    case BILLSAFE = 18;
    case CREDIT_CARD_PAYMENT = 19;
    case IDEAL = 20;
    case CARTE_BLEUE = 21;
    case ONLINE_BANK_TRANSFER = 23;
    case GIROPAY = 24;
    case DANKORT = 25;
    case EPS = 26;
    case PRZELEWY24 = 27;
    case CARTA_SI = 28;
    case POSTEPAY = 29;
    case NORDEA_SOLO_SWEDEN = 30;
    case NORDEA_SOLO_FINLAND = 31;
    case BILLSAFE_INSTALLMENT_PURCHASE = 34;
}
