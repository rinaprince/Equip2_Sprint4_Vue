<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\CustomerRepository;
use App\Repository\OrderRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class CatalegController extends AbstractController
{
    #[Route('/catalogue', name: 'app_cataleg')]
    public function index(VehicleRepository $vehicleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $q = $request->query->get('q', '');
        if( empty($q))
            $query = $vehicleRepository->findAllQuery();
        else
            $query = $vehicleRepository->findByTextQuery($q);

        //$vehiclesQuery = $vehicleRepository->findAllQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            16
        );

        return $this->render('cataleg/index.html.twig', [
            'vehicles' => $pagination,
            'pagination' => $pagination,
            'q'=>$q
        ]);
    }

    #[Route('/add/{id}', name: 'app_add_vehicle', methods: ['GET', 'POST'])]
    public function new($id, Request $request, CustomerRepository $customerRepository, EntityManagerInterface $entityManager, OrderRepository $orderRepository, VehicleRepository $vehicleRepository): Response {
        $customers = $customerRepository->findAll();
        $customer = $customers[0];

        $existingOrder = $orderRepository->findOneBy(['state' => 'Pendent', 'customer' => $customer]);

        if (!$existingOrder) {
            $order = new Order();
            $order->setState('Pendent');
            $order->setCustomer($customer);

            $form = $this->createForm(OrderType::class, $order);
            $form->handleRequest($request);

            $entityManager->persist($order);
            $entityManager->flush();

            $vehicleId = $id;
            $vehicle = $vehicleRepository->find($vehicleId);
            $vehicle->setVehicleOrder($order);

            $entityManager->persist($vehicle);
            $entityManager->flush();
        } else {
            $order = $existingOrder;

            $vehicleId = $id;
            $vehicle = $vehicleRepository->find($vehicleId);
            $vehicle->setVehicleOrder($order);

            $entityManager->persist($vehicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cataleg', [], Response::HTTP_SEE_OTHER);
    }
}

//$customerId = 2;
//$customer = $entityManager->getRepository(Customer::class)->find($customerId);