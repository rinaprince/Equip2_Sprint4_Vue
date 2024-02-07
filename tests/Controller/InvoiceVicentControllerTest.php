<?php
// tests/Entity/InvoiceTest.php

namespace App\Tests\Entity;

use App\Entity\Invoice;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class InvoiceTest extends WebTestCase
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

    public function testAccess(): void
    {
        $clientAdmin = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);

        $clientUser = static::createClient([], [
            'PHP_AUTH_USER' => 'administrative',
            'PHP_AUTH_PW' => 'administrative',
        ]);

        $crawlerAdmin = $clientAdmin->request('GET', '/invoice/');
        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Invoice index');

        $crawlerUser = $clientUser->request('GET', '/invoice/');
        self::assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testCascadeDelete(): void
    {
        $invoice = new Invoice();
        $order = new Order();
        $invoice->setCustomerOrder($order);

        $this->manager->persist($invoice);
        $this->manager->flush();

        $this->manager->remove($invoice);
        $this->manager->flush();

        $loadedOrder = $this->manager->getRepository(Order::class)->find($order->getId());

        $this->assertNull($loadedOrder);
    }
    public function testSoftDelete(): void
    {
        $invoice = new Invoice();
        $this->manager->persist($invoice);
        $this->manager->flush();

        $invoiceId = $invoice->getId();

        $this->manager->remove($invoice);
        $this->manager->flush();

        $loadedInvoice = $this->manager->getRepository(Invoice::class)->find($invoiceId);
        self::assertNotNull($loadedInvoice->getDeletedAt());

    }


}
