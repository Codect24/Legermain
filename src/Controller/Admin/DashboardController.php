<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Entity\ProduitCategorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Comments;
use App\Entity\JobOffer;
use App\Entity\Article;
use App\Entity\Realisation;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('index_dashboard.twig');
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
			MenuItem::section('Échoppe'),
			MenuItem::linkToCrud('Produits', 'fa fa-product', Produit::class),
			MenuItem::linkToCrud('Catégories', 'fa fa-product', ProduitCategorie::class),
            MenuItem::linkToCrud('Offres', 'fa fa-briefcase', JobOffer::class),
            MenuItem::section('Contenu'),
            MenuItem::linkToCrud('Réalisations', 'fa fa-wrench', Realisation::class)
        ];
    }
}
