<?php

namespace App\Controller\Admin;

use App\Entity\JobOfferAnswer;
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
            MenuItem::linkToCrud('Membres', 'fa fa-users', User::class),
            MenuItem::linkToCrud('Articles', 'fa fa-pencil', Article::class),
            MenuItem::linkToCrud('Commentaires', 'fa fa-comments', Comments::class),
            MenuItem::section('Emploi'),
            MenuItem::linkToCrud('Offres', 'fa fa-briefcase', JobOffer::class),
            MenuItem::linkToCrud('Réponses', 'far fa-folder-open', JobOfferAnswer::class)
        ];
    }
}
