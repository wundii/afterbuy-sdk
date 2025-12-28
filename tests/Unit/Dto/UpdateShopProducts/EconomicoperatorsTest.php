<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Dto\UpdateShopProducts;

use PHPUnit\Framework\TestCase;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Economicoperators;
use Wundii\AfterbuySdk\Enum\UpdateActionEconomicoperatorsEnum;

class EconomicoperatorsTest extends TestCase
{
    public function testConstructor(): void
    {
        $economicoperators = new Economicoperators(
            updateActionEconomicoperatorsEnum: UpdateActionEconomicoperatorsEnum::ADD,
            economicoperatorId: [
                10000,
                10001,
                10002,
            ],
        );

        $this->assertSame(UpdateActionEconomicoperatorsEnum::ADD, $economicoperators->getUpdateAction());
        $this->assertSame([10000, 10001, 10002], $economicoperators->getEconomicoperatorId());
    }
}
