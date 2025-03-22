<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum SiteIdEnum: int
{
    case EBAY_COM = 0;
    case EBAY_CANADA = 2;
    case EBAY_UK = 3;
    case EBAY_AUSTRALIA = 15;
    case EBAY_AUSTRIA = 16;
    case EBAY_BELGIUM_FR = 23;
    case EBAY_FRANCE = 71;
    case EBAY_GERMANY = 77;
    case EBAY_ITALY = 101;
    case EBAY_BELGIUM_NL = 123;
    case EBAY_NETHERLANDS = 146;
    case EBAY_SPAIN = 186;
    case EBAY_SWISS = 195;
    case EBAY_IRELAND = 205;
    case EBAY_POLAND = 212;
}
