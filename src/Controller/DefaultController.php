<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_front_office')]
    public function index(): Response
    {
        return $this->render('front_office/index_front.html.twig', [
            'controller_name' => 'FrontOfficeController',
        ]);
    }

    #[Route('/backoffice', name: 'app_back_office')]
    public function back(): Response{
        return $this->render('back_office/index_back.html.twig',
            ['controller_name' => 'BackController']);
    }
}
