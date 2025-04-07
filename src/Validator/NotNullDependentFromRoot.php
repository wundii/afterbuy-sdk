<?php

declare(strict_types=1);

namespace AfterbuySdk\Validator;

use Attribute;
use Symfony\Component\DependencyInjection\Attribute\Exclude;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\LogicException;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
#[Exclude]
class NotNullDependentFromRoot extends Constraint
{
    #[HasNamedArguments]
    public function __construct(
        public string $propertyPath,
        public mixed $propertyValue = null,
        public string $message = '{{ source }} must not be empty if the {{ target }} has a value.',
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct([], $groups, $payload);

        if (! class_exists(PropertyAccess::class)) {
            throw new LogicException(sprintf('The "%s" constraint requires the Symfony PropertyAccess component to use the "propertyPath" option. Try running "composer require symfony/property-access".', static::class));
        }
    }
}
