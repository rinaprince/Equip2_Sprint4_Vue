<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(CustomerRepository $customerRepository): Response
    {
        $user = $customerRepository->findOneBy([]);
        $users = $customerRepository->findAll();
        return $this->render('test/index.html.twig', [
            'user' => $user,
            'users' => $users,
            'controller_name' => 'TestController',
        ]);
    }
}
