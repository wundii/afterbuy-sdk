<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Skus;
use Wundii\AfterbuySdk\Enum\UpdateActionSkusEnum;

class SkusTest extends TestCase
{
    public function testConstructor(): void
    {
        $skus = new Skus(
            updateActionSkusEnum: UpdateActionSkusEnum::ADD,
            skus: [
                'SKU1',
                'SKU2',
                'SKU3',
            ],
        );

        $this->assertSame(UpdateActionSkusEnum::ADD, $skus->getUpdateAction());
        $this->assertSame([
            'SKU1',
            'SKU2',
            'SKU3',
        ], $skus->getSkus());
    }

    public function testExceptionOnEmptySkus(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Skus(
            updateActionSkusEnum: UpdateActionSkusEnum::ADD,
            skus: [],
        );
    }
}
