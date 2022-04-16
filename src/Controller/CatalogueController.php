<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarsRepository;

class CatalogueController extends AbstractController
{
    /**
     * @Route("/catalogue", name="app_catalogue")
     */
    public function index(CarsRepository $repo): Response
    {
        $cars = $repo->findAll();
        return $this->render('catalogue/index.html.twig', [
            'cars' => $cars,
        ]);
    }

    /**
     * @Route("/catalogue/{id}", name="app_catalogue_details")
     */
    public function detail(int $id, CarsRepository $repo): Response
    {
        $car = $repo->find($id);
        return $this->render('catalogue/detail.html.twig', [
            'car' => $car,
        ]);
    }
}
