<?php

namespace App\Test\Controller;

use App\Entity\Provider;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProviderControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/provider/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->client->catchExceptions(false);
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Provider::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Provider index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        //$this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'provider[email]' => 'Testing',
            'provider[phone]' => 'Testing',
            'provider[dni]' => 'Testing',
            'provider[cif]' => 'Testing',
            'provider[address]' => 'Testing',
            'provider[bankTitle]' => 'Testing',
            'provider[managerNif]' => 'Testing',
            'provider[LOPDdoc]' => 'Testing',
            'provider[constitutionArticle]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Provider();
        $fixture->setEmail('My Title');
        $fixture->setPhone('My Title');
        $fixture->setDni('My Title');
        $fixture->setCif('My Title');
        $fixture->setAddress('My Title');
        $fixture->setBankTitle('My Title');
        $fixture->setManagerNif('My Title');
        $fixture->setLOPDdoc('My Title');
        $fixture->setConstitutionArticle('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Provider');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Provider();
        $fixture->setEmail('Value');
        $fixture->setPhone('Value');
        $fixture->setDni('Value');
        $fixture->setCif('Value');
        $fixture->setAddress('Value');
        $fixture->setBankTitle('Value');
        $fixture->setManagerNif('Value');
        $fixture->setLOPDdoc('Value');
        $fixture->setConstitutionArticle('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'provider[email]' => 'Something New',
            'provider[phone]' => 'Something New',
            'provider[dni]' => 'Something New',
            'provider[cif]' => 'Something New',
            'provider[address]' => 'Something New',
            'provider[bankTitle]' => 'Something New',
            'provider[managerNif]' => 'Something New',
            'provider[LOPDdoc]' => 'Something New',
            'provider[constitutionArticle]' => 'Something New',
        ]);

        self::assertResponseRedirects('/provider/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getDni());
        self::assertSame('Something New', $fixture[0]->getCif());
        self::assertSame('Something New', $fixture[0]->getAddress());
        self::assertSame('Something New', $fixture[0]->getBankTitle());
        self::assertSame('Something New', $fixture[0]->getManagerNif());
        self::assertSame('Something New', $fixture[0]->getLOPDdoc());
        self::assertSame('Something New', $fixture[0]->getConstitutionArticle());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Provider();
        $fixture->setEmail('Value');
        $fixture->setPhone('Value');
        $fixture->setDni('Value');
        $fixture->setCif('Value');
        $fixture->setAddress('Value');
        $fixture->setBankTitle('Value');
        $fixture->setManagerNif('Value');
        $fixture->setLOPDdoc('Value');
        $fixture->setConstitutionArticle('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/provider/');
        self::assertSame(0, $this->repository->count([]));
    }
}
