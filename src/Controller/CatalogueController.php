<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    public function detail(int $id, Request $request, SessionInterface $session, CarsRepository $repo): Response
    {
        $car = $repo->find($id);
        if($car === null) {
            throw $this->createNotFoundException('The car doesn\'t exist');
        }
        $basket = $session->get('basket', []);
        if($request->isMethod('POST')) {
            $basket[$id] = $car;
            $session->set('basket', $basket);
        }

        $is_in_basket = array_key_exists($id, $basket);
        return $this->render('catalogue/detail.html.twig', [
            'car' => $car,
            'in_basket' => $is_in_basket,
        ]);
    }
}
