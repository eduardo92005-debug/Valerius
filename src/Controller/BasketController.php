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
        return $this->render('basket/index.html.twig', [
            'basket' => $basket,
            'total' => $total,
        ]);
    }
}
