<?php

namespace App\Validator;

use PHPUnit\Util\Exception;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DniValidator extends ConstraintValidator
{
    const DNI_REGEX = '/^(\d{8})([A-Z])$/';
    public function validate(mixed $value, Constraint $constraint): void
    {

        if (!is_string($value))
            return;

        if (!preg_match(self::DNI_REGEX, $value)) {
            $this->context->buildViolation($constraint->message)->setParameter('{{ string }}', $value)->addViolation();
            return;
        }


        $numbers = substr($value,0,strlen($value)-1);
        $letter = substr($value, -1);

        $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';

        $calculatedLetter = $letras[$numbers % 23];

        // Calcula la letra correspondiente al número de DNI

        // Compara la letra calculada con la letra proporcionada
        if (strtoupper($calculatedLetter) !== strtoupper(substr($value, -1))) {
            $this->context->buildViolation($constraint->message)->setParameter('{{ string }}', $value)->addViolation();
        }
    }
}
