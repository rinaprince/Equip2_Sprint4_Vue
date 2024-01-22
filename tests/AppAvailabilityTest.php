<?php

namespace App\Tests;

use Generator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppAvailabilityTest extends WebTestCase
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
        $crawler = $client->request('GET', $uri);


        $this->assertResponseStatusCodeSame($expectedStatusCode);

    }

    public function getUrlList(): Generator
    {
        yield "Homepage" => ['/', Response::HTTP_OK];
        yield "Provider index" => ['/', Response::HTTP_OK];
    }
}
