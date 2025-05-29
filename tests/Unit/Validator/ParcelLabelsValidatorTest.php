<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests\Unit\Validator;

use stdClass;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\ParcelLabel;
use Wundii\AfterbuySdk\Validator\ParcelLabels;
use Wundii\AfterbuySdk\Validator\ParcelLabelsValidator;

class ParcelLabelsValidatorTest extends ConstraintValidatorTestCase
{
    public function testNullValue(): void
    {
        $this->validator->validate(null, new ParcelLabels());

        $this->assertNoViolation();
    }

    public function testEmptyArray(): void
    {
        $parcelLabels = [];

        $this->validator->validate($parcelLabels, new ParcelLabels());

        $this->assertNoViolation();
    }

    public function testIgnoreInvalidObjects(): void
    {
        $parcelLabels = [
            new stdClass(),
            new ParcelLabel(1, 2, 'Express100'),
        ];

        $constraint = new ParcelLabels();
        $this->validator->validate($parcelLabels, $constraint);

        $this->assertNoViolation();
    }

    public function testValidParcelLabelsWithDifferentLabelNumbers(): void
    {
        $parcelLabels = [
            new ParcelLabel(1, 1, 'Express100'),
            new ParcelLabel(2, 2, 'Express101'),
        ];

        $this->validator->validate($parcelLabels, new ParcelLabels());

        $this->assertNoViolation();
    }

    public function testValidParcelLabelsWithTheSameLabelNumbers(): void
    {
        $parcelLabels = [
            new ParcelLabel(1, 1, 'Express100'),
            new ParcelLabel(2, 1, 'Express100'),
        ];

        $constraint = new ParcelLabels();
        $this->validator->validate($parcelLabels, $constraint);

        $this->assertNoViolation();
    }

    public function testInvalidParcelLabelWhenParcelNumbersAndLabelNumbersAreDifferent(): void
    {
        $parcelLabels = [
            new ParcelLabel(1, 1, 'Express100'),
            new ParcelLabel(2, 1, 'Express101'), // Konflikt bei Paketnummer 1
        ];

        $constraint = new ParcelLabels();
        $this->validator->validate($parcelLabels, $constraint);

        $this->buildViolation($constraint->message)
            ->setParameter('{{ number }}', 'Express101')
            ->assertRaised();
    }

    protected function createValidator(): ParcelLabelsValidator
    {
        return new ParcelLabelsValidator();
    }
}
