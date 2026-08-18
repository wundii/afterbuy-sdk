<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Core;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Core\ValidatorFactory;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;

/**
 * Compiling the service container is expensive, so the validator has to be built
 * once per instance instead of once per request.
 */
class AfterbuyValidatorFactoryTest extends TestCase
{
    public function testValidatorIsBuiltOnlyOnce(): void
    {
        $afterbuy = new Afterbuy($this->afterbuyGlobal());

        $first = $afterbuy->getValidator();
        $second = $afterbuy->getValidator();

        $this->assertInstanceOf(ValidatorInterface::class, $first);
        $this->assertSame($first, $second);
    }

    public function testFactoryReturnsTheSameValidator(): void
    {
        $validatorFactory = new ValidatorFactory();

        $this->assertSame($validatorFactory->create(), $validatorFactory->create());
    }

    /**
     * Separate instances must not share the validator, otherwise a custom
     * validator builder of one instance would leak into another.
     */
    public function testSeparateInstancesGetTheirOwnValidator(): void
    {
        $first = new Afterbuy($this->afterbuyGlobal());
        $second = new Afterbuy($this->afterbuyGlobal());

        $this->assertNotSame($first->getValidator(), $second->getValidator());
    }

    /**
     * Requests without a request dto never validate, so creating the sdk must
     * not compile the container yet.
     */
    public function testConstructorDoesNotBuildTheValidator(): void
    {
        $start = hrtime(true);
        new Afterbuy($this->afterbuyGlobal());
        $constructMs = (hrtime(true) - $start) / 1e6;

        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        $start = hrtime(true);
        $afterbuy->getValidator();
        $validatorMs = (hrtime(true) - $start) / 1e6;

        $this->assertLessThan($validatorMs, $constructMs);
    }

    private function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('accountToken', 'partnerToken', EndpointEnum::SANDBOX);
    }
}
