<?php

namespace App\Test\Controller;

use App\Entity\Professional;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfessionalControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/professional/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Professional::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Professional index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'professional[name]' => 'Testing',
            'professional[lastname]' => 'Testing',
            'professional[address]' => 'Testing',
            'professional[dni]' => 'Testing',
            'professional[phone]' => 'Testing',
            'professional[email]' => 'Testing',
            'professional[cif]' => 'Testing',
            'professional[managerNif]' => 'Testing',
            'professional[LOPDdoc]' => 'Testing',
            'professional[bussinessName]' => 'Testing',
            'professional[constitutionWriting]' => 'Testing',
            'professional[subscription]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Professional();
        $fixture->setName('My Title');
        $fixture->setLastname('My Title');
        $fixture->setAddress('My Title');
        $fixture->setDni('My Title');
        $fixture->setPhone('My Title');
        $fixture->setEmail('My Title');
        $fixture->setCif('My Title');
        $fixture->setManagerNif('My Title');
        $fixture->setLOPDdoc('My Title');
        $fixture->setBussinessName('My Title');
        $fixture->setConstitutionWriting('My Title');
        $fixture->setSubscription('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Professional');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Professional();
        $fixture->setName('Value');
        $fixture->setLastname('Value');
        $fixture->setAddress('Value');
        $fixture->setDni('Value');
        $fixture->setPhone('Value');
        $fixture->setEmail('Value');
        $fixture->setCif('Value');
        $fixture->setManagerNif('Value');
        $fixture->setLOPDdoc('Value');
        $fixture->setBussinessName('Value');
        $fixture->setConstitutionWriting('Value');
        $fixture->setSubscription('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'professional[name]' => 'Something New',
            'professional[lastname]' => 'Something New',
            'professional[address]' => 'Something New',
            'professional[dni]' => 'Something New',
            'professional[phone]' => 'Something New',
            'professional[email]' => 'Something New',
            'professional[cif]' => 'Something New',
            'professional[managerNif]' => 'Something New',
            'professional[LOPDdoc]' => 'Something New',
            'professional[bussinessName]' => 'Something New',
            'professional[constitutionWriting]' => 'Something New',
            'professional[subscription]' => 'Something New',
        ]);

        self::assertResponseRedirects('/professional/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getLastname());
        self::assertSame('Something New', $fixture[0]->getAddress());
        self::assertSame('Something New', $fixture[0]->getDni());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getCif());
        self::assertSame('Something New', $fixture[0]->getManagerNif());
        self::assertSame('Something New', $fixture[0]->getLOPDdoc());
        self::assertSame('Something New', $fixture[0]->getBussinessName());
        self::assertSame('Something New', $fixture[0]->getConstitutionWriting());
        self::assertSame('Something New', $fixture[0]->getSubscription());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Professional();
        $fixture->setName('Value');
        $fixture->setLastname('Value');
        $fixture->setAddress('Value');
        $fixture->setDni('Value');
        $fixture->setPhone('Value');
        $fixture->setEmail('Value');
        $fixture->setCif('Value');
        $fixture->setManagerNif('Value');
        $fixture->setLOPDdoc('Value');
        $fixture->setBussinessName('Value');
        $fixture->setConstitutionWriting('Value');
        $fixture->setSubscription('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/professional/');
        self::assertSame(0, $this->repository->count([]));
    }
}
