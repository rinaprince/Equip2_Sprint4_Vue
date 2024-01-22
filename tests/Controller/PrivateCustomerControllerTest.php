<?php

namespace App\Test\Controller;

use App\Entity\PrivateCustomer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PrivateCustomerControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/private/customer/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(PrivateCustomer::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('PrivateCustomer index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'private_customer[name]' => 'Testing',
            'private_customer[lastname]' => 'Testing',
            'private_customer[address]' => 'Testing',
            'private_customer[dni]' => 'Testing',
            'private_customer[phone]' => 'Testing',
            'private_customer[email]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new PrivateCustomer();
        $fixture->setName('My Title');
        $fixture->setLastname('My Title');
        $fixture->setAddress('My Title');
        $fixture->setDni('My Title');
        $fixture->setPhone('My Title');
        $fixture->setEmail('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('PrivateCustomer');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new PrivateCustomer();
        $fixture->setName('Value');
        $fixture->setLastname('Value');
        $fixture->setAddress('Value');
        $fixture->setDni('Value');
        $fixture->setPhone('Value');
        $fixture->setEmail('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'private_customer[name]' => 'Something New',
            'private_customer[lastname]' => 'Something New',
            'private_customer[address]' => 'Something New',
            'private_customer[dni]' => 'Something New',
            'private_customer[phone]' => 'Something New',
            'private_customer[email]' => 'Something New',
        ]);

        self::assertResponseRedirects('/private/customer/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getLastname());
        self::assertSame('Something New', $fixture[0]->getAddress());
        self::assertSame('Something New', $fixture[0]->getDni());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getEmail());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new PrivateCustomer();
        $fixture->setName('Value');
        $fixture->setLastname('Value');
        $fixture->setAddress('Value');
        $fixture->setDni('Value');
        $fixture->setPhone('Value');
        $fixture->setEmail('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/private/customer/');
        self::assertSame(0, $this->repository->count([]));
    }
}
