<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Feature;

class FeatureTest extends TestCase
{
    public function testConstructor(): void
    {
        $feature = new Feature(
            id: 2000,
            value: 'TestFeature 1',
        );

        $this->assertSame(2000, $feature->getId());
        $this->assertSame('TestFeature 1', $feature->getValue());
    }
}
