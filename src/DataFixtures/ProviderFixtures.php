<?php

namespace App\DataFixtures;

use App\Entity\Provider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class ProviderFixtures extends Fixture
{

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }
    public function load(ObjectManager $manager): void
    {
        $providers = [];

        for ($i = 0 ; $i < 40 ; $i++) {
            $provider = new Provider();
            $provider->setBusinessName($this->faker->domainWord);
            $provider->setEmail($this->faker->companyEmail());
            $provider->setPhone($this->faker->phoneNumber);
            $provider->setDni($this->faker->dni());
            $provider->setCif($this->faker->regexify('/^[0-9]{8}[A-Z]{1}$/'));
            $provider->setAddress($this->faker->address);
            $provider->setBankTitle($this->faker->mimeType());
            $provider->setManagerNif($this->faker->dni());
            $provider->setConstitutionArticle($this->faker->mimeType());
            $provider->setLOPDdoc($this->faker->mimeType());

            $providers[] = $provider;
            $manager->persist($provider);

        }

        $manager->flush();
    }
}
