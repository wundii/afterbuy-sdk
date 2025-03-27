<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum InternalItemTypeEnum: int
{
    case AUCTION = 1;
    case POWER_AUCTION = 2;
    case SHOP_NO_LONGER_EXISTS = 7;
    case OFFER_TO_LOSING_BIDDER = 8;
    case BUY_IT_NOW = 9;
    case SELLER_CENTRAL = 101;
    case FULFILLMENT_BY_AMAZON_SELLER_CENTRAL = 201;
    case FULFILLMENT_BY_AMAZON_MARKETPLACE = 301;
    case MARKETPLACE_WEB_SERVICES = 401;
    case FULFILLMENT_BY_AMAZON_MARKETPLACE_OVER_MARKETPLACE_WEB_SERVICES = 501;
    case MARKETPLACE = 666;
}
