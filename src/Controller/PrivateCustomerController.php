<?php

namespace App\Controller;

use App\Entity\PrivateCustomer;
use App\Form\PrivateCustomerType;
use App\Repository\PrivateCustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/private/customer')]
class PrivateCustomerController extends AbstractController
{
    #[Route('/', name: 'app_private_customer_index', methods: ['GET'])]
    public function index(PrivateCustomerRepository $privateCustomerRepository): Response
    {
        return $this->render('private_customer/index.html.twig', [
            'private_customers' => $privateCustomerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_private_customer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $privateCustomer = new PrivateCustomer();
        $form = $this->createForm(PrivateCustomerType::class, $privateCustomer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($privateCustomer);
            $entityManager->flush();

            return $this->redirectToRoute('app_private_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('private_customer/new.html.twig', [
            'private_customer' => $privateCustomer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_private_customer_show', methods: ['GET'])]
    public function show(PrivateCustomer $privateCustomer): Response
    {
        return $this->render('private_customer/show.html.twig', [
            'private_customer' => $privateCustomer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_private_customer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PrivateCustomer $privateCustomer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PrivateCustomerType::class, $privateCustomer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_private_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('private_customer/edit.html.twig', [
            'private_customer' => $privateCustomer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_private_customer_delete', methods: ['POST'])]
    public function delete(Request $request, PrivateCustomer $privateCustomer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$privateCustomer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($privateCustomer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_private_customer_index', [], Response::HTTP_SEE_OTHER);
    }
}
