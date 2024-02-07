<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/details')]
class DetailController extends AbstractController
{
    #[Route('/{id}', name: 'app_detail')]
    public function index($id,VehicleRepository $vehicleRepository, ImageRepository $imageRepository ): Response
    {
        $images = $imageRepository->findBy(['vehicle' => $id]); // Suponiendo que hay una propiedad 'vehicle' en la entidad Image que se relaciona con el Vehicle
        $vehicles= $vehicleRepository->find($id);
        return $this->render('detail/index.html.twig', [
            'controller_name' => 'DetailController',
            "vehicle"=>$vehicles,
            "images"=>$images,
        ]);
    }
}
