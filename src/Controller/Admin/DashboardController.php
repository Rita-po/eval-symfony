<?php

namespace App\Controller\Admin;

//use App\Entity\User;
use App\Entity\Agent;
use App\Entity\Cible;
use App\Entity\Contact;
use App\Entity\Mission;
use App\Entity\Planque;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Panneau d\'administration');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToRoute('Retourner sur le site', 'fas fa-home', 'home');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-table-columns');
        yield MenuItem::linkToCrud('Agents', 'fas fa-mask', Agent::class);
        yield MenuItem::linkToCrud('Cibles', 'fas fa-bullseye', Cible::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-address-book', Contact::class);
        yield MenuItem::linkToCrud('Planques', 'fas fa-person-shelter', Planque::class);
        yield MenuItem::linkToCrud('Missions', 'fas fa-parachute-box', Mission::class);
        //yield MenuItem::linkToCrud('Administrateur', 'fas fa-user-secret', User::class);
    }
}