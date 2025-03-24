<?php

declare(strict_types=1);

namespace AfterbuySdk\Enum;

enum DefaultFilterEnum: string
{
    case ALLSETS = 'AllSets';
    case VARIATIONSSETS = 'VariationsSets';
    case PRODUCTSETS = 'ProductSets';
    case NOT_ALLSETS = 'Not_AllSets';
    case NOT_VARIATIONSSETS = 'Not_VariationsSets';
    case NOT_PRODUCTSETS = 'Not_ProductSets';
}
