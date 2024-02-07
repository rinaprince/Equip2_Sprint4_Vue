<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Entity\Login;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EmployeeFixtures extends Fixture
{
    const EMPLOYEES_BY_TYPE = 3;

    private Generator $faker;

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create('es_ES');
    }

    public function load(ObjectManager $manager): void
    {

        $employeeTypes = ['administrator', 'administrative'];

        $employee = new Employee();
        $employee->setName("Administrador");
        $employee->setLastname("Administrador");
        $employee->setType("administrator");

        $login = new Login();
        $login->setUsername("admin");
        $login->setPassword($this->hasher->hashPassword($login, "admin"));
        $login->setRole("ROLE_ADMIN");

        $employee->setLogin($login);

        $manager->persist($login);
        $manager->persist($employee);

        $employee = new Employee();
        $employee->setName("Administratiu");
        $employee->setLastname("Administratiu");
        $employee->setType("administrative");

        $login = new Login();
        $login->setUsername("administrative");
        $login->setPassword($this->hasher->hashPassword($login, "administrative"));
        $login->setRole("ROLE_ADMINISTRATIVE");

        $employee->setLogin($login);

        $manager->persist($login);
        $manager->persist($employee);


        foreach ($employeeTypes as $type) {
            for ($i = 0; $i < self::EMPLOYEES_BY_TYPE; $i++) {
                $employee = new Employee();
                $employee->setName($this->faker->firstName);
                $employee->setLastname($this->faker->lastName);
                $employee->setType($type);



                $login = new Login();
                $login->setUsername($this->faker->userName);
                $login->setPassword($this->hasher->hashPassword($login, "1234"));

                if ($type == 'administrador')
                    $login->setRole("ROLE_ADMIN");
                else
                    $login->setRole("ROLE_ADMINISTRATIVE");

                $employee->setLogin($login);

                $manager->persist($login);
                $manager->persist($employee);


            }
        }

        $manager->flush();
    }
}
