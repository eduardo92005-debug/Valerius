<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BasketController extends AbstractController
{
    /**
     * @Route("/basket", name="app_basket")
     */
    public function index(Request $request, SessionInterface $session): Response
    {
        $basket = $session->get('basket', []);
        if($request->isMethod('POST')) {
            unset($basket[$request->request->get('id')]);
            $session->set('basket', $basket);
        }
        $total = array_sum(array_map(function($car) {
            return $car->getPrice();
        }, $basket));
        $arr_car_item = array_map(function ($car) {
            return array("name" => $car->getName(),"price" => $car->getPrice(), "quantity" => 1);
        }, $basket);
        $session->get('total', 0);
        $session->set('total', $total);
        $session->get('model', 0);
        $session->set('model', $arr_car_item);
        return $this->render('basket/index.html.twig', [
            'basket' => $basket,
            'total' => $total,
        ]);
    }
}
