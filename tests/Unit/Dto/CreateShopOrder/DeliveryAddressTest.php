<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\CreateShopOrder;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\Customer;
use Wundii\AfterbuySdk\Dto\CreateShopOrder\DeliveryAddress;
use Wundii\AfterbuySdk\Enum\CountryIsoEnum;

class DeliveryAddressTest extends TestCase
{
    public function testIsCustomerAddressDifferentFalse()
    {
        $customer = new Customer(
            'maxi',
            'maxi@example.com',
            'Max',
            'Mustermann',
            'Musterstraße 1',
            '12345',
            'Musterstadt',
            CountryIsoEnum::GERMANY,
            company: 'Mustermann GmbH',
            street2: '2. OG',
        );
        $address = $this->createDeliveryAddress($customer);

        $this->assertFalse($address->isCustomerAddressDifferent($customer));
    }

    public function testIsCustomerAddressDifferentTrue()
    {
        $customer = new Customer(
            'maxi',
            'maxi@example.com',
            'Erika',
            'Musterfrau',
            'Musterstraße 1',
            '12345',
            'Musterstadt',
            CountryIsoEnum::GERMANY,
        );
        $address = $this->createDeliveryAddress($customer);

        $this->assertTrue($address->isCustomerAddressDifferent($customer));
    }

    public function testToArraySameCustomerFillsData()
    {
        $customer = new Customer(
            'maxi',
            'maxi@example.com',
            'Max',
            'Mustermann',
            'Musterstraße 1',
            '12345',
            'Musterstadt',
            CountryIsoEnum::GERMANY,
            company: 'Mustermann GmbH',
            street2: '2. OG',
        );
        $address = $this->createDeliveryAddress($customer);

        $data = [];
        $result = $address->toArray($data);

        $this->assertSame([], $result);
    }

    public function testToArrayDifferentCustomerFillsData()
    {
        $customer = new Customer(
            'maxi',
            'maxi@example.com',
            'Max',
            'Musterfrau',
            'Musterstraße 1',
            '12345',
            'Musterstadt',
            CountryIsoEnum::GERMANY,
        );
        $address = $this->createDeliveryAddress($customer);

        $data = [];
        $result = $address->toArray($data);

        $this->assertArrayHasKey('Lieferanschrift', $result);
        $this->assertArrayHasKey('KLFirma', $result);
        $this->assertArrayHasKey('KLVorname', $result);
        $this->assertArrayHasKey('KLNachname', $result);
        $this->assertArrayHasKey('KLStrasse', $result);
        $this->assertArrayHasKey('KLStrasse2', $result);
        $this->assertArrayHasKey('KLPLZ', $result);
        $this->assertArrayHasKey('KLOrt', $result);
        $this->assertArrayHasKey('KLLand', $result);
        $this->assertArrayHasKey('KLTelefon', $result);

        $this->assertEquals('Mustermann GmbH', $result['KLFirma']);
        $this->assertEquals('Max', $result['KLVorname']);
        $this->assertEquals('Mustermann', $result['KLNachname']);
    }

    private function createDeliveryAddress(?Customer $customer = null): DeliveryAddress
    {
        return new DeliveryAddress(
            'Max',
            'Mustermann',
            'Musterstraße 1',
            '12345',
            'Musterstadt',
            CountryIsoEnum::GERMANY,
            'Mustermann GmbH',
            '2. OG',
            '0123456789',
            $customer
        );
    }
}
