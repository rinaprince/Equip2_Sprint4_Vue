<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Form\ProviderType;
use App\Repository\ProviderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/providers')]
class ProviderController extends AbstractController
{
    #[Route('/', name: 'app_provider_index', methods: ['GET'])]
    public function index(ProviderRepository $providerRepository,PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMINISTRATIVE',
            null, 'Accés restringit, soles administratius');
        $q = $request->query->get('q','');

        if (empty($q))
            $query = $providerRepository->findAllQuery();
        else
            $query = $providerRepository->findByTextQuery($q);

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            10
        );

        return $this->render('provider/index.html.twig', [
            'pagination' => $pagination,
            'q' => $q,
            'providers' => $pagination->getItems()
        ]);
    }

    #[Route('/new', name: 'app_provider_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $provider = new Provider();
        $form = $this->createForm(ProviderType::class, $provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($provider);
            $entityManager->flush();

            return $this->redirectToRoute('app_provider_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('provider/new.html.twig', [
            'provider' => $provider,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_provider_show', methods: ['GET'])]
    public function show(Provider $provider): Response
    {
        return $this->render('provider/show.html.twig', [
            'provider' => $provider,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_provider_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Provider $provider, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProviderType::class, $provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_provider_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('provider/edit.html.twig', [
            'provider' => $provider,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_provider_delete', methods: ['POST'])]
    public function delete(Request $request, Provider $provider, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$provider->getId(), $request->request->get('_token'))) {
            $entityManager->remove($provider);
            $entityManager->flush();
        }
        return $this->render('provider/_delete_form.html.twig', [
            'provider' => $provider,
            'request' => $request
        ]);
        // return $this->redirectToRoute('app_provider_index', [], Response::HTTP_SEE_OTHER);
    }
}
