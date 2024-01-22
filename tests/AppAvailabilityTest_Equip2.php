<?php

namespace App\Tests;

use Generator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppAvailabilityTest_Equip2 extends WebTestCase
{
    /**
     * @dataProvider getUrlList
     * @param $uri
     * @param $expectedStatusCode
     * @return void
     */
    public function testAcces(string $uri, int $expectedStatusCode): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $crawler = $client->request('GET', $uri);

        $this->assertResponseStatusCodeSame($expectedStatusCode);

    }

    /**
     * @dataProvider getUrlList())
     * @param $uri
     * @param $expectedStatusCode
     * @return void
     */
    public function getUrlList(): Generator
    {
        yield "Homepage" => ['/', Response::HTTP_OK];
        yield "Llista de Provider" => ['/providers/', Response::HTTP_OK];
        yield "Nou Provider" => ['/providers/new', Response::HTTP_OK];
        yield "Editar Provider" => ['/providers/2/edit', Response::HTTP_OK];
        yield "Mostra Provider" => ['/providers/2', Response::HTTP_OK];
        yield "Llista de Vehicles" => ['/vehicles/', Response::HTTP_OK];
        yield "Nou Vehicle" => ['/vehicles/new', Response::HTTP_OK];
        yield "Editar Vehicles" => ['/vehicles/2/edit', Response::HTTP_OK];
        yield "Mostra Vehicle" => ['/vehicles/2', Response::HTTP_OK];
    }
}
