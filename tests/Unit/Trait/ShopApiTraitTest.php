<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Trait;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Extension\DateTime;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Tests\MockClasses\MockShopApiTrait;

class ShopApiTraitTest extends TestCase
{
    private MockShopApiTrait $traitObject;

    protected function setUp(): void
    {
        $this->traitObject = new MockShopApiTrait();
    }

    public function testAddNumberWithNull(): void
    {
        $result = $this->traitObject->addNumber([
            'foo' => 'bar',
        ], 'number', null);

        $this->assertSame([
            'foo' => 'bar',
        ], $result);
    }

    public function testAddNumberWithInt(): void
    {
        $result = $this->traitObject->addNumber([], 'number', 5);

        $this->assertSame([
            'number' => '5',
        ], $result);
    }

    public function testAddNumberWithFloat(): void
    {
        $result = $this->traitObject->addNumber([], 'float', 12.345);

        $this->assertSame([
            'float' => '12,35',
        ], $result);
    }

    public function testAddStringWithNull(): void
    {
        $result = $this->traitObject->addString([
            'foo' => 'bar',
        ], 'key', null);

        $this->assertSame([
            'foo' => 'bar',
        ], $result);
    }

    public function testAddStringWithEmpty(): void
    {
        $result = $this->traitObject->addString([
            'foo' => 'bar',
        ], 'key', '');

        $this->assertSame([
            'foo' => 'bar',
        ], $result);
    }

    public function testAddStringWithValue(): void
    {
        $result = $this->traitObject->addString([], 'k', 'abc');

        $this->assertSame([
            'k' => 'abc',
        ], $result);
    }

    public function testAddBoolWithNull(): void
    {
        $result = $this->traitObject->addBool([
            'foo' => 'bar',
        ], 'b', null);

        $this->assertSame([
            'foo' => 'bar',
        ], $result);
    }

    public function testAddBoolWithTrue(): void
    {
        $result = $this->traitObject->addBool([], 'b', true);

        $this->assertSame([
            'b' => '1',
        ], $result);
    }

    public function testAddBoolWithFalse(): void
    {
        $result = $this->traitObject->addBool([], 'b', false);

        $this->assertSame([
            'b' => '0',
        ], $result);
    }

    public function testAddDateTimeWithNull(): void
    {
        $result = $this->traitObject->addDateTime([
            'foo' => 'bar',
        ], 'dt', null);

        $this->assertSame([
            'foo' => 'bar',
        ], $result);
    }

    public function testAddDateTimeWithDateTime(): void
    {
        $dt = new DateTime('2020-05-04 15:33:21');
        $result = $this->traitObject->addDateTime([], 'dt', $dt);

        $this->assertSame([
            'dt' => '04.05.2020 15:33:21',
        ], $result);
    }

    public function testAddDateWithNull(): void
    {
        $result = $this->traitObject->addDate([
            'foo' => 'bar',
        ], 'date', null);

        $this->assertSame([
            'foo' => 'bar',
        ], $result);
    }

    public function testAddDateWithDateTime(): void
    {
        $dt = new DateTime('2022-08-27 16:45:31');
        $result = $this->traitObject->addDate([], 'date', $dt);

        $this->assertSame([
            'date' => '27.08.2022',
        ], $result);
    }

    public function testAddObjectWithNull(): void
    {
        $result = $this->traitObject->addObject([
            'x' => 'y',
        ], null);

        $this->assertSame([
            'x' => 'y',
        ], $result);
    }

    public function testAddObjectWithNonRequestDtoArrayInterface(): void
    {
        $obj = new class() {};
        $result = $this->traitObject->addObject([
            'x' => 'y',
        ], $obj);

        $this->assertSame([
            'x' => 'y',
        ], $result);
    }

    public function testAddObjectWithRequestDtoArrayInterface(): void
    {
        $obj = new class() implements RequestDtoArrayInterface {
            public function toArray(array $data, ?int $index = null): array
            {
                $data['fromObject_' . $index] = 'foo';
                return $data;
            }
        };

        $result = $this->traitObject->addObject([
            'bar' => 'baz',
        ], $obj, 42);
        $this->assertSame([
            'bar' => 'baz',
            'fromObject_42' => 'foo',
        ], $result);
    }
}
