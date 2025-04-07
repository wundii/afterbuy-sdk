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
class ParcelLabels extends Constraint
{
    #[HasNamedArguments]
    public function __construct(
        public string $message = 'Parcel label number [{{ number }}] must be unique in order',
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct([], $groups, $payload);

        if (! class_exists(PropertyAccess::class)) {
            throw new LogicException(sprintf('The "%s" constraint requires the Symfony PropertyAccess component to use the "propertyPath" option. Try running "composer require symfony/property-access".', static::class));
        }
    }
}
