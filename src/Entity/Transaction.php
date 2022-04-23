<?php
// src/Entity
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Session\Session;
use Beelab\PaypalBundle\Entity\Transaction as BaseTransaction;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Transaction extends BaseTransaction
{

    public function getItems(): array
    {
        $session = new Session();
        $model = $session->get('model', []);
        return $model;
    }
}