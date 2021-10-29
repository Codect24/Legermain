<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Comments;
use App\Entity\Galerie;
use App\Entity\JobOffer;
use App\Entity\Article;
use App\Entity\Image;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();
    }


    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Utilisateurs'),
            MenuItem::linkToCrud('Membres', 'fa fa-tags', User::class),
            MenuItem::linkToCrud('Articles', 'fa fa-tags', Article::class),
            MenuItem::linkToCrud('Commentaires', 'fa fa-tags', Comments::class),
            MenuItem::section('Emploi'),
            MenuItem::linkToCrud('Offres', 'fa fa-tags', JobOffer::class),
            MenuItem::section('Multimedia'),
            MenuItem::linkToCrud('Galeries d\'images', 'fa fa-tags', Galerie::class),
            MenuItem::linkToCrud('Images', 'fa fa-tags', Image::class),
        ];
    }
}
