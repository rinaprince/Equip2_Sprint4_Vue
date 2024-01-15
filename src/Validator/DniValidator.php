<?php

namespace App\Validator;

use PHPUnit\Util\Exception;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DniValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var App\Validator\Dni $constraint */

        //Need to implement the format validation with exceptions

        $numbers = substr($value,0,strlen($value)-1);
        $letter = substr($value, -1);
        $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';

        $calculatedLetter = $letras[$numbers % 23];

        // Calcula la letra correspondiente al número de DNI

        // Compara la letra calculada con la letra proporcionada
        if (strtoupper($calculatedLetter) !== strtoupper(substr($value, -1))) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
