<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\ParcelLabel;

class ParcelLabelsValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (! $constraint instanceof ParcelLabels) {
            throw new UnexpectedTypeException($constraint, ParcelLabels::class);
        }

        $parcelLabelNumber = [];
        $parcelLabelInvalidNumber = [];

        if (! is_iterable($value)) {
            return;
        }

        foreach ($value as $parcelLabel) {
            if (! $parcelLabel instanceof ParcelLabel) {
                continue;
            }

            if (
                isset($parcelLabelNumber[$parcelLabel->getPackageNumber()])
                && $parcelLabelNumber[$parcelLabel->getPackageNumber()] !== $parcelLabel->getParcelLabelNumber()
            ) {
                $parcelLabelInvalidNumber[] = $parcelLabel->getParcelLabelNumber();
            }

            if (
                ! isset($parcelLabelNumber[$parcelLabel->getPackageNumber()])
                && $parcelLabel->getParcelLabelNumber() !== null
            ) {
                $parcelLabelNumber[$parcelLabel->getPackageNumber()] = $parcelLabel->getParcelLabelNumber();
            }
        }

        if ($parcelLabelInvalidNumber !== []) {
            sort($parcelLabelInvalidNumber);

            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ number }}', implode(', ', $parcelLabelInvalidNumber))
                ->addViolation();
        }
    }
}
