<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }

    public function load(ObjectManager $manager): void
    {
        // Obtener todas las entidades Vehicle disponibles
        $vehicles = $manager->getRepository(Vehicle::class)->findAll();

        foreach ($vehicles as $vehicle) {
            // Crear tres imágenes para cada vehículo
            for ($i = 0; $i < 3; $i++) {
                $image = new Image();
                $image->setFilename($this->faker->file('resources/vehicles', 'public/equip3/img/vehicles', false));
                $image->setVehicle($vehicle);
                $manager->persist($image);
            }
        }

        $manager->flush();
    }

    public function getDependencies() : array
    {
        return [VehicleFixtures::class];
    }
}
