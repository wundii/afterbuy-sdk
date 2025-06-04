<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Customer;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Order;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Product;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalog;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;
use Wundii\AfterbuySdk\Enum\CurrencyEnum;
use Wundii\AfterbuySdk\Enum\CustomerIdentificationEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\NoFeedbackEnum;
use Wundii\AfterbuySdk\Enum\ProductIdentificationEnum;
use Wundii\AfterbuySdk\Enum\StockTypeEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionCatalogsEnum;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Request\CreateShopOrderRequest;
use Wundii\AfterbuySdk\Request\UpdateCatalogsRequest;
use Wundii\AfterbuySdk\Tests\MockClasses\MockApiResponse;
use Wundii\AfterbuySdk\Tests\MockClasses\MockLogger;

class SandBoxTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {

        $afterbuyGlobal = new AfterbuyGlobal('account', 'partner');
        $afterbuyGlobal->setEndpointEnum(EndpointEnum::SANDBOX);

        return $afterbuyGlobal;
    }

    public function testSandboxWithDefaultShopApiResponse(): void
    {
        $psrLogger = new MockLogger();
        $request = new CreateShopOrderRequest(
            new Order(
                customerIdentificationEnum: CustomerIdentificationEnum::EMAIL_ADDRESS,
                productIdentificationEnum: ProductIdentificationEnum::AFTERBUY_EXTERNAL_ITEM_NUMBER,
                stockTypeEnum: StockTypeEnum::SHOP,
                buyDate: new DateTime('now'),
                reference: 'TestOrder123',
                currencyEnum: CurrencyEnum::EURO,
                doNotShowVat: false,
                noFeedbackEnum: NoFeedbackEnum::SET_FEEDBACK_DATE_NO_EMAIL,
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
                    ),
                ],
            )
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX, $psrLogger);

        $response = $afterbuy->runRequest($request);

        $this->assertEquals(EndpointEnum::SANDBOX, $response->getEndpoint());
        $this->assertStringContainsString('<sandbox>shop</sandbox>', $response->getXmlResponse());
        $this->assertCount(1, $psrLogger->getLogger());
    }

    public function testSandboxWithDefaultXmlApiResponse(): void
    {
        $psrLogger = new MockLogger();
        $request = new UpdateCatalogsRequest(
            UpdateActionCatalogsEnum::REFRESH,
            [
                new Catalog(
                    123,
                    'Testkatalog',
                ),
            ],
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX, $psrLogger);

        $response = $afterbuy->runRequest($request);

        $this->assertEquals(EndpointEnum::SANDBOX, $response->getEndpoint());
        $this->assertStringContainsString('<Sandbox>XML</Sandbox>', $response->getXmlResponse());
        $this->assertCount(1, $psrLogger->getLogger());
    }

    public function testSandboxWithInjectedResponse(): void
    {
        $file = __DIR__ . '/ResponseFiles/UpdateCatalogsSuccess.xml';

        $psrLogger = new MockLogger();
        $request = new UpdateCatalogsRequest(
            UpdateActionCatalogsEnum::REFRESH,
            [
                new Catalog(
                    123,
                    'Testkatalog',
                ),
            ],
        );
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX, $psrLogger);
        $mockResponse = new MockApiResponse(file_get_contents($file), 200);

        $response = $afterbuy->runRequest($request, $mockResponse);

        $this->assertEquals(EndpointEnum::SANDBOX, $response->getEndpoint());
        $this->assertStringNotContainsString('sandbox="true"', $response->getXmlResponse());
        $this->assertCount(0, $response->getErrorMessages());
        $this->assertCount(0, $response->getWarningMessages());
        $this->assertCount(0, $psrLogger->getLogger());
    }
}
