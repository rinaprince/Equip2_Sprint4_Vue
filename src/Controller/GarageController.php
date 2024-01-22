<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Repository\BrandRepository;
use App\Repository\CustomerRepository;
use App\Repository\InvoiceRepository;
use App\Repository\ModelRepository;
use App\Repository\OrderRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GarageController extends AbstractController
{
    #[Route('/garage', name: 'app_garage')]
    public function index(VehicleRepository $vehicleRepository, ModelRepository $modelRepository, BrandRepository $brandRepository, OrderRepository $orderRepository): Response {
        $vehicles = $vehicleRepository->findAll();

        return $this->render('garage/index.html.twig', [
            'vehicles' => $vehicles
        ]);
    }

    #[Route('/remove/{id}', name: 'remove_order')]
    public function remove($id, VehicleRepository $vehicleRepository, EntityManagerInterface $entityManager): Response {
        $vehicleId = $id;
        $vehicle = $vehicleRepository->find($vehicleId);
        $vehicle->setVehicleOrder(null);

        $entityManager->persist($vehicle);
        $entityManager->flush();

        return $this->redirectToRoute('app_garage', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/close', name: 'close_order')]
    public function close(OrderRepository $orderRepository, EntityManagerInterface $entityManager, InvoiceRepository $invoiceRepository): Response {
        $pendingOrder = $orderRepository->findOneBy(['state' => 'Pendent']);

        if ($pendingOrder) {
            $customer = $pendingOrder->getCustomer();

            $totalPrice = 0;
            foreach ($pendingOrder->getVehicles() as $vehicle) {
                $totalPrice += $vehicle->getSellPrice();
            }

            $actualDate = new \DateTime();

            $invoice = new Invoice();
            $invoice->setDate($actualDate);
            $invoice->setNumber(2);
            $invoice->setCustomer($customer);
            $invoice->setCustomerOrder($pendingOrder);
            $invoice->setPrice($totalPrice);

            $pendingOrder->setState('Tancat');

            $entityManager->persist($invoice);
            $entityManager->persist($pendingOrder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_garage', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/cancel', name: 'cancel_order')]
    public function cancel(CustomerRepository $customerRepository, VehicleRepository $vehicleRepository, OrderRepository $orderRepository, EntityManagerInterface $entityManager): Response {
        $pendingOrder = $orderRepository->findOneBy(['state' => 'Pendent']);

        if ($pendingOrder) {
            $vehicles = $vehicleRepository->findBy(['vehicleOrder' => $pendingOrder]);

            foreach ($vehicles as $vehicle) {
                $vehicle->setVehicleOrder(null);
                $entityManager->persist($vehicle);
            }

            $entityManager->flush();
        }

        return $this->redirectToRoute('app_garage', [], Response::HTTP_SEE_OTHER);
    }

}
