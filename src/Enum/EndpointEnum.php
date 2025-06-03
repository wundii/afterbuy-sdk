<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum EndpointEnum: string
{
    case PROD = 'https://api.afterbuy.de/afterbuy/';
    case SANDBOX = 'http://api.afterbuy.de/afterbuy/';

    public function afterbuyApiUri(): string
    {
        return $this->value . 'ABInterface.aspx';
    }

    public function shopApiUri(): string
    {
        return $this->value . 'ShopInterface.aspx';
    }
}
