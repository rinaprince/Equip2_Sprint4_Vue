<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Repository\InvoiceRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/invoices')]
class InvoiceController extends AbstractController
{
    #[Route('', name: 'app_invoice_index', methods: ['GET'])]
    public function index(InvoiceRepository $InvoiceRepository, PaginatorInterface $paginator, Request $request): Response

    {
        $this->denyAccessUnlessGranted('ROLE_ADMINISTRATIVE',
            null, 'Accés restringit, soles administratius');
        $invoicesQ = $InvoiceRepository->findAllQuery();
        $invoices = $InvoiceRepository->findAll();

        $arrayInvoices = $invoicesQ->getResult(AbstractQuery::HYDRATE_ARRAY);
        for ($i = 0; $i < count($arrayInvoices) ; $i++) {


            $arrayInvoices[$i]['date'] = $arrayInvoices[$i]['date']->format('d/m/Y');;
        }


        $config = array(
            "number" => "Numero",
            "customer" => "Usuario",
            "price" => "Precio",
            "date" => "Fecha",
        );

        $paginator = $paginator->paginate(
            $invoicesQ,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('invoice/index.html.twig', [
            'invoices' => $paginator->getItems(),
            'pagination' => $paginator,
            'data' => $arrayInvoices,
            'config' => $config
        ]);
    }

    #[Route('/new', name: 'app_invoice_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $invoice = new Invoice();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('app_invoice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('invoice/new.html.twig', [
            'invoice' => $invoice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_invoice_show', methods: ['GET'])]
    public function show(Invoice $invoice): Response
    {
        return $this->render('invoice/show.html.twig', [
            'invoice' => $invoice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_invoice_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Invoice $invoice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_invoice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('invoice/edit.html.twig', [
            'invoice' => $invoice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_invoice_delete', methods: ['POST'])]
    public function delete(Request $request, Invoice $invoice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invoice->getId(), $request->request->get('_token'))) {
            $entityManager->remove($invoice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_invoice_index', [], Response::HTTP_SEE_OTHER);
    }
}
