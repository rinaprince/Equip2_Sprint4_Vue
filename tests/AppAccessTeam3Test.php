<?php

namespace App\Tests;

use Generator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppAccessTeam3Test extends WebTestCase
{

    /**
     * @dataProvider getUrlList())
     * @param $uri
     * @param $expectedStatusCode
     * @return void
     */
    public function testAccess($uri, $expectedStatusCode): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $crawler = $client->request('GET', '/');


        $this->assertResponseStatusCodeSame($expectedStatusCode);

    }

    public function getUrlList(): Generator
    {
        //Invoices
        yield "Invoices index" => ['/invoices', Response::HTTP_OK];
        yield "Invoices create" => ['/invoices/new', Response::HTTP_OK];
        yield "Invoices show/delete" => ['/invoices/1', Response::HTTP_OK];
        yield "Invoices edit" => ['/invoices/1/edit', Response::HTTP_OK];

        //Orders
        yield "Orders index" => ['/orders', Response::HTTP_OK];
        yield "Orders create" => ['/orders/new', Response::HTTP_OK];
        yield "Orders show/delete" => ['/orders/1', Response::HTTP_OK];
        yield "Orders edit" => ['/orders/1/edit', Response::HTTP_OK];

        //Catalogue
        yield "Catalogue index" => ['/catalogue', Response::HTTP_OK];

        //Garage
        yield "Garage index" => ['/garage', Response::HTTP_OK];
    }
}
