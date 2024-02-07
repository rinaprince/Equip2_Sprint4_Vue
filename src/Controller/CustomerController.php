<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Doctrine\ORM\AbstractQuery;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CustomerController extends AbstractController
{
    #[Route('/customers', name: 'app_customer')]
    #[IsGranted('ROLE_ADMINISTRATIVE')]
    public function index(CustomerRepository $customerRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $q = $request->query->get('q', '');

        if(empty($q))
            $customerQ = $customerRepository->findAllQuery();
        else{
            $customerQ = $customerRepository->findByText($q);
        }

        $pagination = $paginator->paginate(
            $customerQ,
            $request->query->getInt('page', 1),
            5
        );

        $arrayItem = $customerQ->getResult(AbstractQuery::HYDRATE_ARRAY);

        $config = [
            "name" => "Nom",
            "lastname" => "Cognoms",
            "address" => "Direcció",
            "dni" => "DNI",
            "phone" => "Telèfon",
            "email" => "Correu Electrònic",
            "customer_type" => "Tipus"
        ];

        return $this->render('customer/index.html.twig', [
            'pagination' => $pagination,
            'customers' => $pagination->getItems(),
            'customs' => $arrayItem,
            'config' => $config,
            'routes' => $config,
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