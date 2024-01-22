<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackofficeController extends AbstractController
{
    #[Route('/back', name: 'templates')]
    public function index(): Response
    {
        return $this->render('back_office/index_back.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    #[Route('/front', name: 'templates_front')]
    public function front(): Response
    {
        return $this->render('front_office/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

}
