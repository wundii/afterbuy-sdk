<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Asserts;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalog;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalogs;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionCatalogsEnum;

class UpdateCatalogsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner', EndpointEnum::SANDBOX);
    }

    public function validator(): ValidatorInterface
    {
        $afterbuy = new Afterbuy($this->afterbuyGlobal());
        return $afterbuy->getValidator();
    }

    public function testCatalogsWithoutAsserts(): void
    {
        $catalogs = new Catalogs(
            UpdateActionCatalogsEnum::REFRESH,
            [
                new Catalog(
                    catalogId: 123,
                    catalogName: 'Testkatalog',
                    catalogDescription: str_repeat('a', 255)
                ),
            ],
        );

        $validate = $this->validator()->validate($catalogs);

        $this->assertSame(0, $validate->count());
    }

    public function testCatalogsWithAsserts(): void
    {
        $catalogs = new Catalogs(
            UpdateActionCatalogsEnum::REFRESH,
            [
                new Catalog(
                    catalogId: 123,
                    catalogName: 'Testkatalog',
                    catalogDescription: str_repeat('a', 256)
                ),
            ],
        );

        $validate = $this->validator()->validate($catalogs);

        $messages = array_map(
            fn (ConstraintViolation $violation) => sprintf('%s: %s', $violation->getPropertyPath(), $violation->getMessage()),
            iterator_to_array($validate)
        );

        $expectedMessages = [
            'catalogs[0].catalogDescription: This value is too long. It should have 255 characters or less.',
        ];

        $this->assertEquals($expectedMessages, $messages);
    }
}
