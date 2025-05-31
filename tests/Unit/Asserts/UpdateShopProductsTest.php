<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Asserts;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Wundii\AfterbuySdk\Core\Afterbuy;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\Product;
use Wundii\AfterbuySdk\Dto\UpdateShopProducts\ProductIdent;
use Wundii\AfterbuySdk\Enum\EndpointEnum;

class UpdateShopProductsTest extends TestCase
{
    public function afterbuyGlobal(): AfterbuyGlobal
    {
        return new AfterbuyGlobal('account', 'partner');
    }

    public function validator(): ValidatorInterface
    {
        $errors = [];
        $afterbuy = new Afterbuy($this->afterbuyGlobal(), EndpointEnum::SANDBOX);
        return $afterbuy->getValidator();
    }

    public function testProductWithoutAsserts(): void
    {
        $product = new Product(
            new ProductIdent(
                userProductId: '12345',
                productInsert: false,
                productId: 23456
            ),
            name: str_repeat('a', 255),
            manufacturerPartNumber: str_repeat('a', 255),
            shortDescription: str_repeat('a', 800),
            keywords: str_repeat('a', 1000),
            searchAlias: str_repeat('a', 255),
            freeValue1: str_repeat('a', 500),
            freeValue2: str_repeat('a', 500),
            freeValue3: str_repeat('a', 500),
            freeValue4: str_repeat('a', 500),
            freeValue5: str_repeat('a', 500),
            freeValue6: str_repeat('a', 500),
            freeValue7: str_repeat('a', 500),
            freeValue8: str_repeat('a', 500),
            freeValue9: str_repeat('a', 500),
            freeValue10: str_repeat('a', 500),
            deliveryTime: str_repeat('a', 255),
            googleProductCategory: str_repeat('a', 255),
            material: str_repeat('a', 200),
            itemSize: str_repeat('a', 25),
            canonicalUrl: str_repeat('a', 300),
        );

        $validate = $this->validator()->validate($product);

        $this->assertSame(0, $validate->count());
    }

    public function testProductWithAsserts(): void
    {
        $product = new Product(
            new ProductIdent(
                userProductId: '12345',
                productInsert: false,
                productId: 23456
            ),
            name: str_repeat('a', 256),
            manufacturerPartNumber: str_repeat('a', 256),
            shortDescription: str_repeat('a', 801),
            keywords: str_repeat('a', 1001),
            searchAlias: str_repeat('a', 256),
            freeValue1: str_repeat('a', 501),
            freeValue2: str_repeat('a', 501),
            freeValue3: str_repeat('a', 501),
            freeValue4: str_repeat('a', 501),
            freeValue5: str_repeat('a', 501),
            freeValue6: str_repeat('a', 501),
            freeValue7: str_repeat('a', 501),
            freeValue8: str_repeat('a', 501),
            freeValue9: str_repeat('a', 501),
            freeValue10: str_repeat('a', 501),
            deliveryTime: str_repeat('a', 256),
            googleProductCategory: str_repeat('a', 256),
            material: str_repeat('a', 201),
            itemSize: str_repeat('a', 26),
            canonicalUrl: str_repeat('a', 301),
        );

        $validate = $this->validator()->validate($product);

        $messages = array_map(
            fn (ConstraintViolation $violation) => sprintf('%s: %s', $violation->getPropertyPath(), $violation->getMessage()),
            iterator_to_array($validate)
        );

        $expectedMessages = [
            'canonicalUrl: This value is too long. It should have 300 characters or less.',
            'deliveryTime: This value is too long. It should have 255 characters or less.',
            'freeValue1: This value is too long. It should have 500 characters or less.',
            'freeValue2: This value is too long. It should have 500 characters or less.',
            'freeValue3: This value is too long. It should have 500 characters or less.',
            'freeValue4: This value is too long. It should have 500 characters or less.',
            'freeValue5: This value is too long. It should have 500 characters or less.',
            'freeValue6: This value is too long. It should have 500 characters or less.',
            'freeValue7: This value is too long. It should have 500 characters or less.',
            'freeValue8: This value is too long. It should have 500 characters or less.',
            'freeValue9: This value is too long. It should have 500 characters or less.',
            'freeValue10: This value is too long. It should have 500 characters or less.',
            'googleProductCategory: This value is too long. It should have 255 characters or less.',
            'itemSize: This value is too long. It should have 25 characters or less.',
            'keywords: This value is too long. It should have 1000 characters or less.',
            'manufacturerPartNumber: This value is too long. It should have 255 characters or less.',
            'material: This value is too long. It should have 200 characters or less.',
            'name: This value is too long. It should have 255 characters or less.',
            'searchAlias: This value is too long. It should have 255 characters or less.',
            'shortDescription: This value is too long. It should have 800 characters or less.',
        ];

        $this->assertEquals($expectedMessages, $messages);
    }
}
