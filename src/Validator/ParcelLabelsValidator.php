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
        $pracelLabelInvalidNumber = [];

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
                $pracelLabelInvalidNumber[] = $parcelLabel->getParcelLabelNumber();
            }

            if (
                ! isset($parcelLabelNumber[$parcelLabel->getPackageNumber()])
                && $parcelLabel->getParcelLabelNumber() !== null
            ) {
                $parcelLabelNumber[$parcelLabel->getPackageNumber()] = $parcelLabel->getParcelLabelNumber();
            }
        }

        if ($pracelLabelInvalidNumber !== []) {
            sort($pracelLabelInvalidNumber);

            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ number }}', implode(', ', $pracelLabelInvalidNumber))
                ->addViolation();
        }
    }
}
