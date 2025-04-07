<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum PlattformEnum: string
{
    case AMAZONSC = 'AmazonSC';
    case AUVITO = 'Auvito';
    case AUXION = 'Auxion';
    case AZUBO = 'azubo';
    case EBAY = 'eBay';
    case ELIMBO = 'elimbo';
    case GUTSCHRIFT = 'gutschrift';
    case HOOD = 'Hood';
    case NOT_AMAZONSC = 'not_AmazonSC';
    case NOT_AUVITO = 'not_Auvito';
    case NOT_AUXION = 'not_Auxion';
    case NOT_AZUBO = 'not_azubo';
    case NOT_EBAY = 'not_eBay';
    case NOT_ELIMBO = 'not_elimbo';
    case NOT_GUTSCHRIFT = 'not_gutschrift';
    case NOT_HOOD = 'not_Hood';
}
