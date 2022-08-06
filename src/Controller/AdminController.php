<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Entity\SearchCar;
use App\Form\SearchCarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
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
            'admin' => true,
            'form' => $form->createView()


        ]);
    }

    #[Route('/admin/cars/new', name: 'admin_car_new')]
    #[Route('/admin/cars/{id}', name: 'admin_car_edit') ]
    public function new_and_edit(Car $car = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$car) {
          $car = new Car();
        }


        $form = $this->createForm(CarType::class,$car);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          $modify = $car->getId() !== null;
          $entityManager->persist($car);
          $entityManager->flush();
          $this->addFlash("success", $modify ? 'car have been modified' : 'car have been add');
          return $this->redirectToRoute('admin');
        }


        return $this->render('admin/edit.html.twig', [
            'controller_name' => 'AdminFoodController',
            'food' => $car,
            'form' => $form->createView(),
            'new' => $car->getId() !== null
        ]);
    }

    #[Route('/admin/cars/delete/{id}', name: 'car_destroy')]
    public function destroy(Car $car, Request $request, EntityManagerInterface $entityManager): Response
    {
      if($this->isCsrfTokenValid("SUP". $car->getId(), $request->get('_token')))
      {
        $entityManager->remove($car);
        $entityManager->flush();
        $this->addFlash("success", 'car have been deleted');
        return $this->redirectToRoute('admin');
      }
    }
}
