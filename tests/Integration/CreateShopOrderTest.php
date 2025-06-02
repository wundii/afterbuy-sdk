<?php

declare(strict_types=1);

namespace Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Customer;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Order;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Product;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Enum\CustomerIdentificationEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\ProductIdentificationEnum;
use Wundii\AfterbuySdk\Enum\StockTypeEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Extension\HttpClientHelper;
use Wundii\AfterbuySdk\Request\CreateShopOrderRequest;

class CreateShopOrderTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testShopOrderUriMinimal(): void
    {
        $buyDate = new DateTime('now');
        $order = new Order(
            customerIdentificationEnum: CustomerIdentificationEnum::EMAIL_ADDRESS,
            productIdentificationEnum: ProductIdentificationEnum::AFTERBUY_EXTERNAL_ITEM_NUMBER,
            stockTypeEnum: StockTypeEnum::SHOP,
            buyDate: $buyDate,
            customer: new Customer(
                'Mustermann',
                'mustermann@example.com',
                'Max',
                'Mustermann',
                'Musterstraße 1',
                '12345',
                'Musterstadt',
                CountryIsoEnum::GERMANY,
            ),
            products: [
                new Product(
                    1234567890,
                    'Test Product',
                    29.99,
                    19.0,
                    2,
                    tags: [
                        'TestTag1',
                        'TestTag2',
                    ]
                ),
            ],
        );
        $request = new CreateShopOrderRequest($order);

        $url = $request->url(EndpointEnum::SANDBOX);
        $query = $request->query();

        $expectedUri = 'http://api.afterbuy.de/afterbuy/ShopInterface_test.aspx?Action=new' .
            '&Kundenerkennung=1&Artikelerkennung=2&Bestandart=shop&BuyDate=' . $buyDate->format('d.m.Y%20H:i:s') .
            '&kbenutzername=Mustermann&KVorname=Max&KNachname=Mustermann&KStrasse=Musterstra%C3%9Fe%201&KPLZ=12345&KOrt=Musterstadt&Kemail=mustermann@example.com&KLand=DE' .
            '&PosAnz=1&Artikelnr_1=1234567890&Artikelname_1=Test%20Product&ArtikelEpreis_1=29%2C99&ArtikelMwSt_1=19%2C00&ArtikelMenge_1=2&Tag_1_1=TestTag1&Tag_2_1=TestTag2' .
            '';

        $this->assertSame($expectedUri, HttpClientHelper::prepareUri($url, $query));
    }
}
