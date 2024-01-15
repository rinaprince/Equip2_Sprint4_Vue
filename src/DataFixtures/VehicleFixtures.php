<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\Vehicle;
use App\Repository\ProviderRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Faker\Provider\Fakecar;


class VehicleFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(private ProviderRepository $providerRepository,
    )
    {
        $this->faker = Factory::create('es_ES');
        $this->faker->addProvider(new Fakecar($this->faker));
    }

    public function load(ObjectManager $manager): void
    {
        $models = [];
        $brands = [];
        for ($i = 0; $i < 26; $i++) {
            $vehicleArray = $this->faker->vehicleArray;

            $brandName = $vehicleArray["brand"];

            if (empty(array_filter($brands, function ($v) use ($brandName) {
                if ($v->getName() == $brandName)
                    return true;
            }))) {
                $brand = new Brand();
                $brand->setName($brandName);
                $manager->persist($brand);

                $brands[] = $brand;
            }

            $model = new Model();
            $model->setName($vehicleArray["model"]);
            $model->setGearType("Automatic");
            $model->setBrand($brand);
            $model->setDescription("no se");
            $model->setYear($this->faker->biasedNumberBetween(1990, date('Y'), 'sqrt'));

            $manager->persist($model);

            $models[] = $model;
        }

        for ($i = 0; $i < 20; $i++) {
            $vehicle = new Vehicle();
            $vehicle->setColor($this->faker->colorName());
            $vehicle->setFuel($this->faker->vehicleFuelType);
            $vehicle->setDescription($this->faker->text(200));
            $vehicle->setPlate($this->faker->vehicleRegistration('[0-9]{4}[A-Z]{3}'));
            $vehicle->setObservedDamages($this->faker->text(255));
            $vehicle->setBuyPrice(12121.2);
            $vehicle->setChassisNumber($this->faker->vin);
            $vehicle->setGearShit($this->faker->vehicleGearBoxType);
            $vehicle->setIsNew($this->faker->boolean);
            $vehicle->setKilometers($this->faker->biasedNumberBetween(0, 30000));
            $vehicle->setSellPrice(1212121);
            $vehicle->setRegistrationDate(new DateTime());
            $vehicle->setIva(0);
            $vehicle->setTransportIncluded(true);

            $providers = $this->providerRepository->findAll();

            $provider = $providers[array_rand($providers)];
            $vehicle->setProvider($provider);

            $model = $models[array_rand($models)];
            $vehicle->setModel($model);

            $manager->persist($vehicle);
            // $manager->persist($product);

        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return
            [ProviderFixtures::class];
    }


}
