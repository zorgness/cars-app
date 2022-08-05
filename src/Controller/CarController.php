<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    #[Route('/', name: 'cars')]
    public function index(CarRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {

        $cars = $paginator->paginate(
          $repository->findAllWithPaginator(),
          $request->query->getInt('page', 1), /*page number*/
          6 /*limit per page*/
      );


        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
            'cars' => $cars,
        ]);
    }
}
