<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    #[Route('/', name: 'cars')]
    public function index(CarRepository $repository): Response
    {
        $cars = $repository->findAll();
        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
            'cars' => $cars,
        ]);
    }
}
