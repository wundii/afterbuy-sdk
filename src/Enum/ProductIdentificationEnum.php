<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum ProductIdentificationEnum: int
{
    case AFTERBUY_PRODUCT_ID = 0;
    case AFTERBUY_ARTICLE_NUMBER = 1;
    case AFTERBUY_EXTERNAL_ITEM_NUMBER = 2;
    case MANUFACTURER_EAN = 13;
}
