<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Validator;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Wundii\AfterbuySdk\Validator\NotNullDependentFromRoot;
use Wundii\AfterbuySdk\Validator\NotNullDependentFromRootValidator;

class NotNullDependentFromRootTest extends ConstraintValidatorTestCase
{
    public function testNullValue(): void
    {
        $this->validator->validate(null, new NotNullDependentFromRoot('dependency', 'value'));

        $this->assertNoViolation();
    }

    public function testNoViolationWhenPropertyMatchesAndTargetValue(): void
    {
        $object = (object) [
            'dependency' => 'value',
            'target' => 'not_null',
        ];

        $constraint = new NotNullDependentFromRoot(
            propertyPath: 'dependency',
            propertyValue: 'value',
        );

        $this->setRoot($object);
        $this->setObject($object);
        $this->validator->validate($object->target, $constraint);

        $this->assertNoViolation();
    }

    public function testNoViolationWhenPropertyMatchesAndTargetIsNull(): void
    {
        $object = (object) [
            'dependency' => 'value',
            'target' => null,
        ];

        $constraint = new NotNullDependentFromRoot(
            propertyPath: 'dependency',
            propertyValue: 'value',
        );

        $this->setRoot($object);
        $this->setObject($object);
        $this->validator->validate($object->target, $constraint);

        $this->assertNoViolation();
    }

    public function testNoViolationWhenPropertyNoMatchesAndTargetValue(): void
    {
        $object = (object) [
            'dependency' => 'different_value',
            'target' => 'not_null',
        ];

        $constraint = new NotNullDependentFromRoot(
            propertyPath: 'dependency',
            propertyValue: 'value',
        );

        $this->setRoot($object);
        $this->setObject($object);
        $this->validator->validate($object->target, $constraint);

        $this->assertNoViolation();
    }

    public function testViolationWhenDependencyNoMatchesAndTargetIsNull(): void
    {
        $object = (object) [
            'dependency' => 'different_value',
            'target' => null,
        ];

        $constraint = new NotNullDependentFromRoot(
            propertyPath: 'dependency',
            propertyValue: 'value',
        );

        $this->setRoot($object);
        $this->setObject($object);
        $this->validator->validate($object->target, $constraint);

        $this->buildViolation($constraint->message)
            ->atPath('dependency')
            ->atPath('property.path.dependency')
            ->setParameter('{{ source }}', 'path')
            ->setParameter('{{ target }}', 'dependency')
            ->assertRaised();
    }

    protected function createValidator(): NotNullDependentFromRootValidator
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        return new NotNullDependentFromRootValidator($propertyAccessor);
    }
}
