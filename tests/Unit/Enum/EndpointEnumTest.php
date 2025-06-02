<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Enum;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Enum\EndpointEnum;

class EndpointEnumTest extends TestCase
{
    public function testAfterbuyApiUriForProd()
    {
        $endpoint = EndpointEnum::PROD;
        $expected = 'https://api.afterbuy.de/afterbuy/ABInterface.aspx';
        $this->assertEquals($expected, $endpoint->afterbuyApiUri());
    }

    public function testAfterbuyApiUriForSandbox()
    {
        $endpoint = EndpointEnum::SANDBOX;
        $expected = 'http://api.afterbuy.de/afterbuy/ABInterface.aspx';
        $this->assertEquals($expected, $endpoint->afterbuyApiUri());
    }

    public function testShopApiUriForProd()
    {
        $endpoint = EndpointEnum::PROD;
        $expected = 'https://api.afterbuy.de/afterbuy/ShopInterface.aspx';
        $this->assertEquals($expected, $endpoint->shopApiUri());
    }

    public function testShopApiUriForSandbox()
    {
        $endpoint = EndpointEnum::SANDBOX;
        $expected = 'http://api.afterbuy.de/afterbuy/ShopInterface_test.aspx';
        $this->assertEquals($expected, $endpoint->shopApiUri());
    }
}