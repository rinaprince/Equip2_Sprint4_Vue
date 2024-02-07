<?php

namespace App\DataFixtures;

use App\Entity\Invoice;
use App\Repository\PrivateCustomerRepository;
use App\Repository\OrderRepository;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Generator;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InvoiceFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    private PrivateCustomerRepository $privateCustomerRep;
    private OrderRepository $orderRep;
    public function __construct(PrivateCustomerRepository $privateCustomerRep, OrderRepository $orderRep)
    {
        $this->faker = Factory::create('es_ES');
        $this->privateCustomerRep = $privateCustomerRep;
        $this->orderRep = $orderRep;
    }

    public function load(ObjectManager $manager): void
    {
        $invoices = [];

        $usedOrders  = [];
        for ($i = 0; $i < 10; $i++) {
            $invoice = new Invoice();
            $invoice->setPrice($this->faker->numberBetween(100000, 1000000));
            $dateString = $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d');
            $date = DateTime::createFromFormat('Y-m-d', $dateString);
            $invoice->setDate($date);
            $invoice->setNumber($this->faker->numberBetween('1000000', '2000000'));


            $orders = $this->orderRep->findAll();



            do
                $order = $orders[array_rand($orders)];
            while (in_array($order, $usedOrders));
            $usedOrders[] = $order;


            $invoice->setCustomer($order->getCustomer());
            $invoice->setCustomerOrder($order);

            $manager->persist($invoice);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        // TODO: Implement getDependencies() method.
        return [OrderFixtures::class, CustomerFixtures::class];
    }
}