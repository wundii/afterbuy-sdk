<?php

declare(strict_types=1);

namespace AfterbuySdk\Validator;

use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;
use Symfony\Component\PropertyAccess\Exception\UninitializedPropertyException;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class NotNullDependentFromValidator extends ConstraintValidator
{
    public function __construct(
        private readonly ?PropertyAccessorInterface $propertyAccessor = null
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (! $constraint instanceof NotNullDependentFrom) {
            throw new UnexpectedTypeException($constraint, NotNullDependentFrom::class);
        }

        if (! $this->propertyAccessor instanceof PropertyAccessorInterface) {
            throw new UnexpectedTypeException($this->propertyAccessor, PropertyAccessorInterface::class);
        }

        $propertyPath = $constraint->propertyPath;
        $propertyValue = $constraint->propertyValue;
        $object = $this->context->getObject();
        $property = $this->context->getPropertyPath();

        if ($object === null) {
            return;
        }

        $propertyExplode = explode('.', $property);
        $property = end($propertyExplode);

        try {
            $comparedValue = $this->propertyAccessor->getValue($object, $propertyPath);
        } catch (NoSuchPropertyException $e) {
            throw new ConstraintDefinitionException(sprintf('Invalid property path "%s" provided to "%s" constraint: ', $propertyPath, get_debug_type($constraint)) . $e->getMessage(), 0, $e);
        } catch (UninitializedPropertyException) {
            $comparedValue = null;
        }

        if ($comparedValue !== $propertyValue && $value === null) {
            $this->context
                ->buildViolation($constraint->message)
                ->atPath($propertyPath)
                ->setParameter('{{ source }}', $property)
                ->setParameter('{{ target }}', $propertyPath)
                ->addViolation();
        }
    }
}
