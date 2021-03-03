<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CollectionsValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\Collections */

        if (null === $value || '' === $value) {
            return;
        }

        if ($value->isEmpty()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', '')
                ->addViolation();
        }
    }
}
