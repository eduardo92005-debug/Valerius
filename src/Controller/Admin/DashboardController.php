<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Entity\User;
use App\Entity\Repair;
use App\Entity\Comment;
use App\Entity\Profile;
use App\Entity\Service;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Page');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Cars', 'fas fa-car', Cars::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Comments', 'fas fa-message', Comment::class);
        yield MenuItem::linkToCrud('Repair', 'fas fa-message', Repair::class);
        yield MenuItem::linkToCrud('Profile', 'fas fa-message', Profile::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-message', Service::class);
    }
}
