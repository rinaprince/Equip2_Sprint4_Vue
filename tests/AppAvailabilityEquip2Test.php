<?php

namespace App\Tests;

use App\Repository\LoginRepository;
use Generator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppAvailabilityEquip2Test extends WebTestCase
{
    /**
     * @dataProvider getUrlListAnon
     * @param $uri
     * @param $expectedStatusCode
     * @return void
     */
    public function testAccessAnon(string $uri, int $expectedStatusCode): void
    {
        $client = static::createClient();
        $client->catchExceptions(true);
        $crawler = $client->request('HEAD', $uri);

        $this->assertResponseStatusCodeSame($expectedStatusCode);

    }

    /**
     * @dataProvider getUrlList())
     * @param $uri
     * @param $expectedStatusCode
     * @return void
     */
    public function getUrlListAnon(): Generator
    {
        yield "Homepage" => ['/', Response::HTTP_OK];
        yield "Llista de Provider" => ['/providers', Response::HTTP_FOUND];
        yield "Nou Provider" => ['/providers/new', Response::HTTP_FOUND];
        yield "Editar Provider" => ['/providers/2/edit', Response::HTTP_FOUND];
        yield "Mostra Provider" => ['/providers/2', Response::HTTP_FOUND];
        yield "Llista de Vehicles" => ['/vehicles/', Response::HTTP_FOUND];
        yield "Nou Vehicle" => ['/vehicles/new', Response::HTTP_FOUND];
        yield "Editar Vehicles" => ['/vehicles/2/edit', Response::HTTP_FOUND];
        yield "Mostra Vehicle" => ['/vehicles/2', Response::HTTP_FOUND];

    }

    /**
     * @dataProvider getUrlListPrivate
     * @param string $uri
     * @param int $expectedStatusCode
     * @return void
     */
    public function testAccessPrivate(string $uri, int $expectedStatusCode): void
    {
        $client = static::createClient();
        $client->catchExceptions(true);

        $loginRepository = static::getContainer()->get(LoginRepository::class);
        // retrieve the test user
        $testUser = $loginRepository->findOneByUsername('private');
        $client->loginUser($testUser);

        $crawler = $client->request('HEAD', $uri);

        $this->assertResponseStatusCodeSame($expectedStatusCode);

    }


    public function getUrlListPrivate(): Generator
    {
        yield "Homepage" => ['/', Response::HTTP_OK];
        yield "Llista de Provider" => ['/providers', Response::HTTP_FORBIDDEN];
        yield "Nou Provider" => ['/providers/new', Response::HTTP_FORBIDDEN];
        yield "Editar Provider" => ['/providers/2/edit', Response::HTTP_FORBIDDEN];
        yield "Mostra Provider" => ['/providers/2', Response::HTTP_FORBIDDEN];
        yield "Llista de Vehicles" => ['/vehicles/', Response::HTTP_FORBIDDEN];
        yield "Nou Vehicle" => ['/vehicles/new', Response::HTTP_FORBIDDEN];
        yield "Editar Vehicles" => ['/vehicles/2/edit', Response::HTTP_FORBIDDEN];
        yield "Mostra Vehicle" => ['/vehicles/2', Response::HTTP_FORBIDDEN];

    }

    /**
     * @dataProvider getUrlListAdmin
     * @param string $uri
     * @param int $expectedStatusCode
     * @return void
     */
    public function testAccessAdmin(string $uri, int $expectedStatusCode): void
    {
        $client = static::createClient();
        $client->catchExceptions(true);

        $loginRepository = static::getContainer()->get(LoginRepository::class);
        // retrieve the test user
        $testUser = $loginRepository->findOneByUsername('admin');
        $client->loginUser($testUser);

        $crawler = $client->request('HEAD', $uri);

        $this->assertResponseStatusCodeSame($expectedStatusCode);

    }


    public function getUrlListAdmin(): Generator
    {
        yield "Homepage" => ['/', Response::HTTP_OK];
        yield "Llista de Provider" => ['/providers', Response::HTTP_OK];
        yield "Nou Provider" => ['/providers/new', Response::HTTP_OK];
        yield "Editar Provider" => ['/providers/2/edit', Response::HTTP_OK];
        yield "Mostra Provider" => ['/providers/2', Response::HTTP_OK];
        yield "Llista de Vehicles" => ['/vehicles/', Response::HTTP_OK];
        yield "Nou Vehicle" => ['/vehicles/new', Response::HTTP_OK];
        yield "Editar Vehicles" => ['/vehicles/2/edit', Response::HTTP_OK];
        yield "Mostra Vehicle" => ['/vehicles/2', Response::HTTP_OK];

    }
}
