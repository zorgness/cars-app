<?php

namespace App\Controller;

use App\Entity\SearchCar;
use App\Form\SearchCarType;
use App\Repository\CarRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{

    #[Route('/', name: 'home')]
    public function home()
    {
      return $this->render('car/home.html.twig', [
        'controller_name' => 'CarController'
      ]);
    }

    #[Route('/cars', name: 'cars')]
    public function index(CarRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {


        $searchCars = new SearchCar();
        $form = $this->createForm(SearchCarType::class, $searchCars);
        $form->handleRequest($request);

        $cars = $paginator->paginate(
          $repository->findAllWithPaginator($searchCars),
          $request->query->getInt('page', 1), /*page number*/
          6 /*limit per page*/
      );


        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
            'cars' => $cars,
            'admin' => false,
            'form' => $form->createView()

        ]);
    }
}
