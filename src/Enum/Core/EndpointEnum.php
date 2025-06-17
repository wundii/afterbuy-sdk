<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum\Core;

enum EndpointEnum: string
{
    case PROD = 'prod';
    case SANDBOX = 'sandbox';

    public function domain(): string
    {
        return match ($this) {
            self::PROD => 'https://api.afterbuy.de/afterbuy/',
            self::SANDBOX => 'http://api.afterbuy.de/afterbuy/',
        };
    }

    public function afterbuyApiUri(): string
    {
        return $this->domain() . 'ABInterface.aspx';
    }

    public function shopApiUri(): string
    {
        return $this->domain() . 'ShopInterface.aspx';
    }
}
