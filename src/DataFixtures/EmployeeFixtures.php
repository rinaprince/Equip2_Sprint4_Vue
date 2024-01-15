<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EmployeeFixtures extends Fixture
{
    const EMPLOYEES_BY_TYPE = 3;

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }

    public function load(ObjectManager $manager): void
    {

        $employeeTypes = ['administrator', 'administrative'];

        foreach ($employeeTypes as $type) {
            for ($i = 0; $i < self::EMPLOYEES_BY_TYPE; $i++) {
                $employee = new Employee();
                $employee->setName($this->faker->firstName);
                $employee->setLastname($this->faker->lastName);
                $employee->setType($type);

                $manager->persist($employee);

            }
        }

        $manager->flush();
    }
}
