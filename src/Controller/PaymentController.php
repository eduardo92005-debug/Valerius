<?php

namespace App\Controller;

use App\Entity\Transaction;
use Beelab\PaypalBundle\Paypal\Service;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payment", name="app_payment")
     */
    public function index(Service $service, Session $session, ManagerRegistry $doctrine): Response
    {
        $amount = $session->get('total',0);
        $transaction = new Transaction($amount);
        $entity_manager = $doctrine->getManager();

        try {
            $response = $service->setTransaction($transaction)->start();
            $entity_manager->persist($transaction);
            $entity_manager->flush();
            return $this->redirect($response->getRedirectUrl());
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
        
    }
}
