<?php

namespace App\Test\Controller;

use App\Entity\Invoice;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InvoiceControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/invoice/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Invoice::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Invoice index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'invoice[number]' => 'Testing',
            'invoice[price]' => 'Testing',
            'invoice[date]' => 'Testing',
            'invoice[customer]' => 'Testing',
            'invoice[customerOrder]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Invoice();
        $fixture->setNumber('My Title');
        $fixture->setPrice('My Title');
        $fixture->setDate('My Title');
        $fixture->setCustomer('My Title');
        $fixture->setCustomerOrder('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Invoice');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Invoice();
        $fixture->setNumber('Value');
        $fixture->setPrice('Value');
        $fixture->setDate('Value');
        $fixture->setCustomer('Value');
        $fixture->setCustomerOrder('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'invoice[number]' => 'Something New',
            'invoice[price]' => 'Something New',
            'invoice[date]' => 'Something New',
            'invoice[customer]' => 'Something New',
            'invoice[customerOrder]' => 'Something New',
        ]);

        self::assertResponseRedirects('/invoice/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNumber());
        self::assertSame('Something New', $fixture[0]->getPrice());
        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getCustomer());
        self::assertSame('Something New', $fixture[0]->getCustomerOrder());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Invoice();
        $fixture->setNumber('Value');
        $fixture->setPrice('Value');
        $fixture->setDate('Value');
        $fixture->setCustomer('Value');
        $fixture->setCustomerOrder('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/invoice/');
        self::assertSame(0, $this->repository->count([]));
    }
}
