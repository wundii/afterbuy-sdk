<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\Integration;

use AfterbuySdk\Afterbuy;
use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\UpdateShopProducts\Product;
use AfterbuySdk\Dto\UpdateShopProducts\ProductIdent;
use AfterbuySdk\Enum\BasePriceFactorEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Request\UpdateShopProductsRequest;
use AfterbuySdk\Response\UpdateShopProductsResponse;
use AfterbuySdk\Tests\DomFormatter;
use AfterbuySdk\Tests\MockClasses\MockApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;

class UpdateShopProductsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function testValidateMaxProducts(): void
    {
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $products = array_map(fn ($i) => new Product(new ProductIdent(), (string) ($i + 1)), range(0, 250));
        $this->assertCount(251, $products);

        $request = new UpdateShopProductsRequest(
            $products,
        );

        $this->expectExceptionMessage('Products can not contain more than 250 products');
        $request->payload($afterbuyGlobal);
    }

    public function testUpdateShopProductsRequestBasic(): void
    {
        $file = __DIR__ . '/RequestFiles/UpdateShopProductsBasic.xml';
        $afterbuyGlobal = clone $this->afterbuyGlobal();

        $request = new UpdateShopProductsRequest(
            [
                new Product(
                    new ProductIdent(
                        null,
                        true,
                        '12345ABCD',
                        0,
                        0,
                    ),
                    'ABInterfaceNew TestItem Warning',
                    ean: 'EAN',
                ),
                new Product(
                    new ProductIdent(
                        null,
                        true,
                        '12346ABCD',
                        0,
                        0,
                        'EAN',
                    ),
                    'ABInterfaceNew TestItem',
                    shortDescription: 'TestKurzbeschreibung',
                    memo: 'TestMemo',
                    description: 'TestBeschreibung',
                    keywords: 'TestKeywords',
                    quantity: 10,
                    auctionQuantity: 100,
                    stock: true,
                    discontinued: true,
                    mergeStock: true,
                    unitOfQuantity: 2.55,
                    basePriceFactorEnum: BasePriceFactorEnum::LITER,
                    minimumStock: 5,
                    sellingPrice: 1.23,
                    buyingPrice: 2.34,
                    dealerPrice: 3.45,
                    level: 1000,
                    position: 10000,
                    titleReplace: true,
                ),
            ]
        );
        $payload = $request->payload($afterbuyGlobal);
        $expected = file_get_contents($file);

        $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));
    }
    //
    // public function testUpdateShopProductsRequestParcelLabel(): void
    // {
    //     $file = __DIR__ . '/RequestFiles/UpdateShopProductsParcelLabel.xml';
    //     $afterbuyGlobal = clone $this->afterbuyGlobal();
    //
    //     $request = new UpdateShopProductsRequest(
    //         [
    //             new Product(
    //                 12345600,
    //                 shippingInfo: new ShippingInfo(
    //                     parcelLabels: [
    //                         new ParcelLabel(12345600, 1, '0123DHL-1'),
    //                         new ParcelLabel(12345600, 5, '0123DHL-5'),
    //                         new ParcelLabel(12345601, 4, '0123DHL-4'),
    //                         new ParcelLabel(12345601, 5, '0123DHL-5'),
    //                         new ParcelLabel(12345602, 1, '0123DHL-1'),
    //                         new ParcelLabel(12345603, 2, '0123DHL-2'),
    //                         new ParcelLabel(12345603, 3, '0123DHL-3'),
    //                     ]
    //                 ),
    //             ),
    //         ]
    //     );
    //     $payload = $request->payload($afterbuyGlobal);
    //     $expected = file_get_contents($file);
    //
    //     $this->assertEquals(DomFormatter::xml($expected), DomFormatter::xml($payload));
    // }

    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testUpdateShopProductsResponseBasic(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateShopProductsSuccess.xml';

        $request = new UpdateShopProductsRequest(
            [
                new Product(
                    new ProductIdent(),
                    'ABInterfaceNew TestItem',
                ),
            ]
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);
        $result = $response->getResult();

        $this->assertInstanceOf(UpdateShopProductsResponse::class, $response);
        $this->assertCount(1, $result->getNewProducts());
        $this->assertCount(1, $response->getWarningMessages());
        $this->assertSame(4, $response->getWarningMessages()[0]->getWarningCode());
    }
}
