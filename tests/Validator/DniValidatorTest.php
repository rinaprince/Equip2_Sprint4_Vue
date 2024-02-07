<?php

namespace App\Tests\Validator;

use App\Validator\Dni;
use App\Validator\DniValidator;
use Doctrine\DBAL\Exception\ConstraintViolationException;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class DniValidatorTest extends ConstraintValidatorTestCase
{
    public function testValidDNINotRaiseViolation(): void
    {

        $dni = new Dni();
        $this->validator->validate("12345678Z", $dni);

        $this->assertNoViolation();
    }

    public function testViolationRaisedIfOnlyCharacters(): void
    {
        $dniToTest = "ABCDEFGHI";
        $this->validator->validate($dniToTest, new Dni(message: 'Invalid DNI'));

        $this->buildViolation('Invalid DNI')
            ->setParameter('{{ string }}', $dniToTest)
            ->assertRaised();
    }


    public function testViolationRaisedIfCharIsWrong(): void
    {
        $dniToTest = "12345678B";
        $this->validator->validate($dniToTest, new Dni(message: 'Invalid DNI'));

        $this->buildViolation('Invalid DNI')
            ->setParameter('{{ string }}', $dniToTest)
            ->assertRaised();
    }

    public function testViolationNotRaisedIfNull(): void
    {
        $dniToTest = null;
        $this->validator->validate($dniToTest, new Dni(message: 'Invalid DNI'));
        $this->assertNoViolation();
    }

    public function testExceptionRaisedIfNotAString(): void
    {
        $this->expectException(UnexpectedValueException::class);
        $dniToTest = 123;
        $this->validator->validate($dniToTest, new Dni(message: 'Invalid DNI'));

    }



    /**
     * @return ConstraintValidatorInterface
     */
    protected function createValidator(): ConstraintValidatorInterface
    {
        return new DniValidator();
    }
}
