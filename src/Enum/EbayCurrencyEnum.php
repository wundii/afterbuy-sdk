<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum EbayCurrencyEnum: string
{
    case EURO = 'EUR';
    case BOSNIA_HERZEGOVINA_CONVERTIBLE_MARK = 'BAM';
    case BULGARISCHER_LEVA = 'BGN';
    case CROATIAN_KUNA = 'HRK';
    case CZECH_KORUNA = 'CZK';
    case DANISH_KRONE = 'DKK';
    case GREAT_BRITISH_POUND = 'GBP';
    case HUNGARIAN_FORINT = 'HUF';
    case MACEDONIAN_DENAR = 'MKD';
    case NORWEGIAN_KRONE = 'NOK';
    case POLISH_ZLOTY = 'PLN';
    case ROMANIAN_LEU = 'RON';
    case SERBIAN_DINAR = 'RSD';
    case SWEDISH_KRONA = 'SEK';
    case SWISS_FRANC = 'CHF';
    case UNITED_STATES_DOLLAR = 'USD';
}
