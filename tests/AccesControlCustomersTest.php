<?php


use Generator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccesControlCustomersTest extends WebTestCase
{

    /**
     * @dataProvider getUrlCustomers())
     * @param $uri
     * @param $expectedStatusCode
     * @return void
     */
    public function testAccessCustomers($uri, $expectedStatusCode): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(\App\Repository\LoginRepository::class);
        $testUser = $userRepository->findOneByUsername('admin');
        $client->loginUser($testUser);
        $client->catchExceptions(false);
        $crawler = $client->request('HEAD', $uri);
        $this->assertResponseStatusCodeSame($expectedStatusCode);
    }

    public function getUrlCustomers(): Generator
    {
        yield "Homepage" => ['/', Response::HTTP_OK];
        yield "Provider index" => ['/', Response::HTTP_OK];

        // Employees
        yield "Employee index" => ['/employees', Response::HTTP_OK];
        yield "Employee new" => ['/employees/new', Response::HTTP_OK];
        yield "Employee show" => ['/employees/2/details', Response::HTTP_OK];
        yield "Employee edit" => ['/employees/2/edit', Response::HTTP_OK];
        yield "Employee delete" => ['/employees/2/delete', Response::HTTP_OK];

        // Customer
        yield "Customer index" => ['/customers', Response::HTTP_OK];

        // Customer Privat
        yield "Private Customer new" => ['/private/customers', Response::HTTP_OK];
        yield "Private Customer show" => ['/private/customers/new', Response::HTTP_OK];
        yield "Private Customer edit" => ['/private/customers/2/edit', Response::HTTP_OK];
        yield "Private Customer delete" => ['/private/customers/2', Response::HTTP_OK];

        // Customer Professional
        yield "Professional Customer new" => ['/professional/customers', Response::HTTP_OK];
        yield "Professional Customer show" => ['/professional/customers/new', Response::HTTP_OK];
        yield "Professional Customer edit" => ['/professional/customers/2/edit', Response::HTTP_OK];
        yield "Professional Customer delete" => ['/professional/customers/2', Response::HTTP_OK];
    }





    /*

public function testHomepageWorks(): void
{
    $client = static::createClient();
    $crawler = $client->request('GET', '/');


    $this->assertResponseStatusCodeSame(200);
}

public function testStatus404IfPageDoesntExist(): void
{
    $client = static::createClient();
    $client->catchExceptions(true);
    $crawler = $client->request('GET', '/asdf');


    $this->assertResponseStatusCodeSame(404);
}

*/

}
