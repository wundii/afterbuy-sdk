<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Core;

use Exception;
use RuntimeException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Validator\ConstraintValidatorFactoryInterface;
use Symfony\Component\Validator\ContainerConstraintValidatorFactory;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;

/**
 * Builds the validator once per instance. Compiling the service container is
 * expensive, so doing it on every request would dominate the runtime of bulk
 * calls. It stays lazy because requests without a request dto never validate.
 */
final class ValidatorFactory
{
    private ?ValidatorInterface $validator = null;

    public function __construct(
        private readonly ?ValidatorBuilder $validatorBuilder = null,
    ) {
    }

    public function create(): ValidatorInterface
    {
        return $this->validator ??= $this->build();
    }

    private function build(): ValidatorInterface
    {
        $validationBuilder = $this->validatorBuilder ?? Validation::createValidatorBuilder();
        $validationBuilder->enableAttributeMapping();
        $validationBuilder->setConstraintValidatorFactory($this->constraintValidatorFactory());

        return $validationBuilder->getValidator();
    }

    private function constraintValidatorFactory(): ConstraintValidatorFactoryInterface
    {
        $containerBuilder = new ContainerBuilder();

        /**
         * register all services are needed for the validator
         */
        $containerBuilder->register(PropertyAccessorInterface::class, PropertyAccessor::class)
            ->addArgument(PropertyAccessor::MAGIC_GET | PropertyAccessor::MAGIC_SET)
            ->addArgument(PropertyAccessor::THROW_ON_INVALID_PROPERTY_PATH)
            ->addArgument(null)
            ->addArgument(new ReflectionExtractor([], null, null, true));

        /**
         * autowire all validators
         */
        try {
            $phpFileLoader = new PhpFileLoader($containerBuilder, new FileLocator(__DIR__));
            $phpFileLoader->load(__DIR__ . '/../Config/Container.php');
        } catch (Exception $exception) {
            throw new RuntimeException('Error loading container file: ' . $exception->getMessage(), $exception->getCode(), $exception);
        }

        $containerBuilder->compile();

        return new ContainerConstraintValidatorFactory($containerBuilder);
    }
}
