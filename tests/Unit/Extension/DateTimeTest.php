<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Extension;

use DateTime as DateTimeBase;
use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Extension\DateTime;

class DateTimeTest extends TestCase
{
    public function testConstructWithDefaultNow(): void
    {
        $date = new DateTime();
        $this->assertInstanceOf(DateTimeBase::class, $date);
        $this->assertEquals('Europe/Berlin', $date->getTimezone()->getName());
    }

    public function testConstructWithValidDateString(): void
    {
        $date = new DateTime('2025-06-01 04:05:06');
        $this->assertEquals('2025-06-01 04:05:06', $date->format('Y-m-d H:i:s'));
        $this->assertEquals('Europe/Berlin', $date->getTimezone()->getName());
    }
}
