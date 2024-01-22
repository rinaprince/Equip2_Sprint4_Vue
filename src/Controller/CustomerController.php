<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'app_customer')]
    public function index(CustomerRepository $customerRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $q = $request->query->get('q', '');

        $pagination = $paginator->paginate(
            $customerRepository->findAllQuery(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('customer/index.html.twig', [
            'pagination' => $pagination,

            'customers' => $pagination->getItems(),
            'q' => $q
        ]);
    }
}

/* 'customers' => $customerRepository->findBy([], ["name" => "DESC"], 1), */



/*<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'app_customer')]
    public function index(CustomerRepository $customerRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $q = $request->query->get('q', '');

        $pagination = $paginator->paginate(
            $customerRepository->findAllQuery(),
            $request->query->getInt('page', 1),
            5
        );

        // Convertir objetos a arrays
        $customersArray = [];
        foreach ($pagination->getItems() as $customer) {
            $customersArray[] = [
                'id' => $customer->getId(),
                'name' => $customer->getName(),
                'lastname' => $customer->getLastname(),
                'address' => $customer->getAddress(),
                'dni' => $customer->getDni(),
                'phone' => $customer->getPhone(),
                'email' => $customer->getEmail(),
                'type' => $customer->getType(),
            ];
        }

        return $this->render('customer/index.html.twig', [
            'pagination' => $pagination,
            'customers' => $customersArray,
            'q' => $q
        ]);
    }
}

 */